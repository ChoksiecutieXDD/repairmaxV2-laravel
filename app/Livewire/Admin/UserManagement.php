<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\AdminProfile;
use App\Models\Notification;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.admin')]
#[Title('User Management | Repairmax')]
class UserManagement extends Component
{
    use WithPagination;
    
    public $search = '';
    public $filterRole = 'all';
    
    // Create Admin Form Properties
    public $showCreateAdminModal = false;
    public $adminEmail = '';
    public $adminFirstName = '';
    public $adminLastName = '';
    public $adminPhone = '';
    public $adminDepartment = '';
    public $adminLevel = 'admin';
    public $adminPassword = '';
    
    // Create User Form Properties
    public $showCreateUserModal = false;
    public $userEmail = '';
    public $userFirstName = '';
    public $userLastName = '';
    public $userPhone = '';
    public $userPassword = '';
    
    // Messages
    public $successMessage = '';
    public $errorMessage = '';
    
    // Delete Confirmation
    public $showDeleteConfirmationModal = false;
    public $userToDeleteId = null;
    public $userToDeleteName = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getUsers()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('email', 'like', "%{$this->search}%")
                  ->orWhere('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%");
        }

        if ($this->filterRole !== 'all') {
            $query->where('role', $this->filterRole);
        }

        return $query->paginate(10);
    }

    public function openCreateAdminModal()
    {
        Log::info('openCreateAdminModal called');
        $this->errorMessage = '';
        $this->successMessage = '';
        $this->resetForm();
        $this->showCreateAdminModal = true;
        Log::info('showCreateAdminModal set to: ' . $this->showCreateAdminModal);
    }

    public function closeCreateAdminModal()
    {
        Log::info('closeCreateAdminModal called');
        $this->showCreateAdminModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->adminEmail = '';
        $this->adminFirstName = '';
        $this->adminLastName = '';
        $this->adminPhone = '';
        $this->adminDepartment = '';
        $this->adminLevel = 'admin';
        $this->adminPassword = '';
        $this->successMessage = '';
        $this->errorMessage = '';
    }

    public function openCreateUserModal()
    {
        Log::info('openCreateUserModal called');
        $this->errorMessage = '';
        $this->successMessage = '';
        $this->resetUserForm();
        $this->showCreateUserModal = true;
        Log::info('showCreateUserModal set to: ' . $this->showCreateUserModal);
    }

    public function closeCreateUserModal()
    {
        Log::info('closeCreateUserModal called');
        $this->showCreateUserModal = false;
        $this->resetUserForm();
    }

    public function resetUserForm()
    {
        $this->userEmail = '';
        $this->userFirstName = '';
        $this->userLastName = '';
        $this->userPhone = '';
        $this->userPassword = '';
        $this->successMessage = '';
        $this->errorMessage = '';
    }


    public function createAdmin()
    {
        Log::info('createAdmin() method called');
        Log::info('Email: ' . $this->adminEmail);
        
        // Clear previous messages
        $this->successMessage = '';
        $this->errorMessage = '';

        // Validation
        if (!$this->adminEmail) {
            $this->errorMessage = 'Email is required';
            Log::warning('Email required validation failed');
            return;
        }

        if (!$this->adminFirstName) {
            $this->errorMessage = 'First name is required';
            Log::warning('First name required validation failed');
            return;
        }

        if (!$this->adminLastName) {
            $this->errorMessage = 'Last name is required';
            Log::warning('Last name required validation failed');
            return;
        }

        if (!$this->adminPassword || strlen($this->adminPassword) < 8) {
            $this->errorMessage = 'Password must be at least 8 characters';
            Log::warning('Password validation failed');
            return;
        }

        // Check if email exists
        if (User::where('email', $this->adminEmail)->exists()) {
            $this->errorMessage = 'Email already exists in the system';
            Log::warning('Email already exists: ' . $this->adminEmail);
            return;
        }

        try {
            // Create the user
            $newAdmin = User::create([
                'email' => $this->adminEmail,
                'first_name' => $this->adminFirstName,
                'last_name' => $this->adminLastName,
                'phone' => $this->adminPhone ?: null,
                'password' => Hash::make($this->adminPassword),
                'role' => 'admin',
                'is_active' => true,
                'is_verified' => true,
                'remember_token' => Str::random(10),
            ]);

            Log::info('User created with ID: ' . $newAdmin->id);

            // Create admin profile
            AdminProfile::create([
                'user_id' => $newAdmin->id,
                'admin_level' => $this->adminLevel,
                'permissions' => json_encode([
                    'manage_users' => true,
                    'manage_repairs' => true,
                    'manage_appointments' => true,
                    'manage_inventory' => true,
                    'view_reports' => true,
                    'manage_admins' => $this->adminLevel === 'super_admin',
                ]),
                'department' => $this->adminDepartment ?: 'General',
                'created_by_id' => auth()->id(),
            ]);

            Log::info('AdminProfile created for user ID: ' . $newAdmin->id);

            // Notify other admins
            $otherAdmins = User::where('role', 'admin')
                ->where('id', '!=', $newAdmin->id)
                ->get();

            foreach ($otherAdmins as $admin) {
                Notification::create([
                    'admin_id' => $admin->id,
                    'user_id' => null,
                    'related_model' => 'admin',
                    'related_id' => $newAdmin->id,
                    'title' => 'New Admin Created',
                    'message' => "New admin: {$newAdmin->first_name} {$newAdmin->last_name}",
                    'is_read' => false,
                ]);
            }

            // Set success message
            $this->successMessage = "✅ Admin created successfully! Email: {$this->adminEmail}";
            Log::info('Admin created successfully: ' . $this->adminEmail);
            
            // Reset form and close modal
            $this->resetForm();
            $this->showCreateAdminModal = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Error creating admin: ' . $e->getMessage();
            Log::error('Error creating admin: ' . $e->getMessage());
        }
    }

    public function createUser()
    {
        Log::info('createUser() method called');
        Log::info('Email: ' . $this->userEmail);
        
        // Clear previous messages
        $this->successMessage = '';
        $this->errorMessage = '';

        // Validation
        if (!$this->userEmail) {
            $this->errorMessage = 'Email is required';
            Log::warning('Email required validation failed');
            return;
        }

        if (!$this->userFirstName) {
            $this->errorMessage = 'First name is required';
            Log::warning('First name required validation failed');
            return;
        }

        if (!$this->userLastName) {
            $this->errorMessage = 'Last name is required';
            Log::warning('Last name required validation failed');
            return;
        }

        if (!$this->userPassword || strlen($this->userPassword) < 8) {
            $this->errorMessage = 'Password must be at least 8 characters';
            Log::warning('Password validation failed');
            return;
        }

        // Check if email exists
        if (User::where('email', $this->userEmail)->exists()) {
            $this->errorMessage = 'Email already exists in the system';
            Log::warning('Email already exists: ' . $this->userEmail);
            return;
        }

        try {
            // Create the user
            $newUser = User::create([
                'email' => $this->userEmail,
                'first_name' => $this->userFirstName,
                'last_name' => $this->userLastName,
                'phone' => $this->userPhone ?: null,
                'password' => Hash::make($this->userPassword),
                'role' => 'user',
                'is_active' => true,
                'is_verified' => true,
                'remember_token' => Str::random(10),
            ]);

            Log::info('User created with ID: ' . $newUser->id);

            // Set success message
            $this->successMessage = "✅ User created successfully! Email: {$this->userEmail}";
            Log::info('User created successfully: ' . $this->userEmail);
            
            // Reset form and close modal
            $this->resetUserForm();
            $this->showCreateUserModal = false;

        } catch (\Exception $e) {
            $this->errorMessage = 'Error creating user: ' . $e->getMessage();
            Log::error('Error creating user: ' . $e->getMessage());
        }
    }


    public function blockUser($userId)
    {
        User::find($userId)?->update(['is_active' => false]);
    }

    public function unblockUser($userId)
    {
        User::find($userId)?->update(['is_active' => true]);
    }

    public function confirmDeleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            if ($user->id === auth()->id()) {
                $this->errorMessage = 'Cannot delete your own account';
                return;
            }
            $this->userToDeleteId = $userId;
            $this->userToDeleteName = $user->first_name . ' ' . $user->last_name;
            $this->showDeleteConfirmationModal = true;
        }
    }

    public function cancelDeleteUser()
    {
        $this->showDeleteConfirmationModal = false;
        $this->userToDeleteId = null;
        $this->userToDeleteName = '';
    }

    public function deleteUser()
    {
        try {
            if (!$this->userToDeleteId) return;

            $user = User::find($this->userToDeleteId);
            
            if (!$user) {
                $this->errorMessage = 'User not found';
                $this->cancelDeleteUser();
                return;
            }

            $userName = $user->first_name . ' ' . $user->last_name;
            $user->delete();
            
            $this->successMessage = "✅ User deleted successfully! ($userName)";
            Log::info('User deleted: ' . $userName . ' (ID: ' . $this->userToDeleteId . ')');
            
            $this->cancelDeleteUser();
            
        } catch (\Exception $e) {
            $this->errorMessage = 'Error deleting user: ' . $e->getMessage();
            Log::error('Error deleting user: ' . $e->getMessage());
            $this->cancelDeleteUser();
        }
    }

    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => $this->getUsers()
        ]);
    }
}
