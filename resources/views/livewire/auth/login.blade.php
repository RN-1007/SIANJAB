<div>
    @if (session()->has('error') || $errors->any())
        <div class="fixed top-6 right-8 z-50 max-w-lg w-full px-4">
            <div
                class="bg-red-600/80 text-white rounded-xl shadow-lg backdrop-blur-md border border-red-400/50 px-6 py-4 flex items-center space-x-3 animate-fade-in">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
                <div>
                    @if (session()->has('error'))
                        <div class="font-semibold">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <ul class="mt-1 text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="w-full max-w-4xl px-4 mx-auto">
        <div class="login-card rounded-2xl overflow-hidden shadow-2xl">
            <div class="flex flex-col md:flex-row">
                <!-- Left side - Image with Logo overlay -->
                <div class="md:w-1/2 relative">
                    <img src="{{ asset('img/image.png') }}" alt="Pemandangan Magetan" class="w-full h-full object-cover"
                        style="object-fit:fill;
                            height: 100%; 
                            width: 100%;
                            display: block;
                            border-top-left-radius: 15px; 
                            border-bottom-left-radius: 15px;
                            transition: transform .2s ease-in-out; 
                            cursor: pointer;" onmouseover="this.style.transform='scale(1.05)';"
                        onmouseout="this.style.transform='scale(1)';">
                </div>

                <!-- Right side - Login Form -->
                <div class="md:w-1/2 flex items-center justify-center bg-black/60"
                    style="border-top-right-radius:15px; border-bottom-right-radius:15px;">
                    <div class="w-full flex flex-col items-center justify-center p-8">
                        <div class="mb-8 flex flex-col items-center justify-center">
                            <img src="{{ asset('img/logo_sianjab.png') }}" alt="Logo"
                                style="width: 60px; height: 60px;">
                            <h3 class="text-2xl font-bold text-white tracking-wide mt-2">Login SiAnjab</h3>
                        </div>
                        <form wire:submit.prevent="login" class="space-y-6 w-full">
                            <div class="relative">
                                <input type="text" wire:model="username"
                                    class="w-full px-4 py-3 bg-white/10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-light"
                                    placeholder="Username">
                                <span class="absolute right-4 top-3.5 text-gray-400">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <div class="relative">
                                <input type="password" wire:model="password" id="password"
                                    class="w-full px-4 py-3 bg-white/10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-light"
                                    placeholder="Password">
                                <span class="absolute right-4 top-3.5 text-gray-400 cursor-pointer" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200 font-light flex items-center justify-center space-x-2"
                                wire:loading.attr="disabled" wire:target="login">
                                <span wire:loading wire:target="login">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <span>Loading...</span>
                                </span>
                                <span wire:loading.remove wire:target="login">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>