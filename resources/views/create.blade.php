
@extends('welcome')

@section('content')
    


@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<div class="mx-auto max-w-lg p-6 bg-white rounded-lg shadow-md">
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Heading -->
        <h5 class="text-xl font-medium text-gray-900">Register for an account</h5>

        <!-- Name -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
            <input type="text" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
            <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="editor">Editor</option>
            </select>
        </div>

        <!-- Position -->
        <div>
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Position</label>
            <select id="position" name="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                <option value="student">Student</option>
                <option value="trainer">Trainer</option>
                <option value="administrator">Administrator</option>
            </select>
        </div>

        <!-- Age -->
        <div>
            <label for="age" class="block mb-2 text-sm font-medium text-gray-900">Age</label>
            <input type="number" id="age" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Profile Image -->
        <div>
            <label for="profile_image" class="block mb-2 text-sm font-medium text-gray-900">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image" class="block w-full text-sm text-gray-500 file:border file:border-gray-300 file:bg-gray-50 file:text-gray-700 file:rounded-lg file:p-2.5 file:cursor-pointer">
        </div>

        <!-- Street -->
        <div>
            <label for="street" class="block mb-2 text-sm font-medium text-gray-900">Street</label>
            <input type="text" id="street" name="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Street 2 -->
        <div>
            <label for="street_2" class="block mb-2 text-sm font-medium text-gray-900">Street 2 (Optional)</label>
            <input type="text" id="street_2" name="street_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <!-- District -->
        <div>
            <label for="district" class="block mb-2 text-sm font-medium text-gray-900">District</label>
            <input type="text" id="district" name="district" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- City -->
        <div>
            <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
            <input type="text" id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Province -->
        <div>
            <label for="province" class="block mb-2 text-sm font-medium text-gray-900">Province</label>
            <input type="text" id="province" name="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Postal Code -->
        <div>
            <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register</button>
        </div>
    </form>


@endsection
