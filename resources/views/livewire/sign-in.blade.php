<form wire:submit="submit" class="space-y-5">

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
            Email Address
        </label>
        <input wire:model="email" type="email" placeholder="gallery@example.com"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all @error('email') border-red-400 bg-red-50 @enderror">
        @error('email')
            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
            Password
        </label>
        <input wire:model="password" type="password" placeholder="Enter your password"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all @error('password') border-red-400 bg-red-50 @enderror">
        @error('password')
            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="flex items-center justify-between pt-1">
        <label class="flex items-center gap-2 cursor-pointer">
            <input wire:model="remember" type="checkbox"
                   class="w-4 h-4 rounded border-gray-300 text-black focus:ring-black cursor-pointer">
            <span class="text-sm text-gray-500">Remember me</span>
        </label>
    </div>

    <button type="submit"
            class="w-full bg-black text-white py-3.5 rounded-xl text-sm font-semibold hover:bg-gray-800 active:bg-gray-900 transition-all duration-200 mt-2 tracking-wide">
        Sign In
    </button>

</form>
