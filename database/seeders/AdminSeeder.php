<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\coffee_shop_admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder creates test admin accounts with hashed passwords
     * and email addresses for testing the admin login with OTP functionality.
     */
    public function run(): void
    {
        // Create main admin account
        coffee_shop_admin::create([
            'admin_name' => 'Super Admin',
            'admin_email' => 'admin@kapena.com',
            'admin_password' => Hash::make('Admin@123'),
            'email_verified_at' => null, // Will be set after OTP verification
        ]);

        // Create test admin account
        coffee_shop_admin::create([
            'admin_name' => 'Test Admin',
            'admin_email' => 'testadmin@kapena.com',
            'admin_password' => Hash::make('Test@123'),
            'email_verified_at' => null,
        ]);

        // Create another test admin
        coffee_shop_admin::create([
            'admin_name' => 'Manager Admin',
            'admin_email' => 'manager@kapena.com',
            'admin_password' => Hash::make('Manager@123'),
            'email_verified_at' => null,
        ]);

        $this->command->info('Admin accounts created successfully!');
        $this->command->info('');
        $this->command->info('Test Admin Credentials:');
        $this->command->info('------------------------');
        $this->command->info('Email: admin@kapena.com | Password: Admin@123');
        $this->command->info('Email: testadmin@kapena.com | Password: Test@123');
        $this->command->info('Email: manager@kapena.com | Password: Manager@123');
        $this->command->info('');
        $this->command->info('Navigate to /adminlogin to login with these credentials.');
        $this->command->info('You will receive an OTP code via email for verification.');
    }
}
