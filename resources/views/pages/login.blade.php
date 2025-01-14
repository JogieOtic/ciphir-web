@extends('layouts.headersidebar')

@section('title','login')
@section('content')
<div
    class="w-screen h-screen"
    style="background-image: url('{{ asset('img/background2.png') }}');
        background-size: cover;
        background-position: center;" >
    <div class="backdrop-blur-sm w-screen h-screen flex justify-center items-center pt-16">
        <div class="flex flex-row rounded-md overflow-clip">
            {{-- login card --}}
            <div class="bg-[#243464] py-6 space-y-6 px-10 font-inter flex flex-col justify-center text-slate-200">
                <h6 class="text-4xl text-center font-bold">Welcome</h6>
                <h3 class="text-md font-normal">Please enter your credentials</h3>
                <form action="{{ route('login') }}" method="POST">
                        @csrf <!-- CSRF protection -->
                        <!-- Username Field -->
                        <div class="flex flex-col space-y-6">
                            <div>
                                <label for="username" class="block pl-1 mb-2 text-sm font-medium tracking-wider">Usermame</label>
                                <input type="text" name="username" placeholder="juandelacruz" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
                            </div>
                            <!-- Password Field with Eye Icon -->
                            <div>
                                <label for="password" class="block pl-1 mb-2 text-sm font-medium tracking-wider">Password</label>
                                <div class="flex items-center">
                                    <input type="password" id="passwordInput" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required/>
                                <span class="-ml-8 cursor-pointer text-gray-700" id="togglePassword">
                                    <!-- Font Awesome Eye Slash Icon by Default -->
                                     <i class="fas fa-eye-slash text-gray-400"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex flex-col justify-center items-center mt-4 h-12">

                        <!-- Error message display section -->
                        @if ($errors->any())
                            <div class="pb-2 text-red-500 text-xs">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}!</div>
                            @endforeach
                            </div>
                        @endif
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium h-fit rounded-full text-sm w-full sm:w-auto px-5 py-2 text-center">Login</button>
                        </div>

                </form>
            </div>

            <div class="bg-[#ffff]/75 px-8 py-6 flex flex-col w-[42rem] text-[#223a83]">
                <div class="w-full flex justify-end">
                    <img src="/img/eye1.png" alt="Eye Logo" class="eye-logo">
                </div>
                <div class="-mt-16">
                    <h5 class="text-7xl font-bold font-inter pb-6">CIPHIR</h5>
                <h5 class="text-3xl font-medium font-inter w-[36rem] ">Centralized Information Platform for Community Hazards and Infrastructure Reports</h5>
                <hr class="w-4/8 h-1 my-4 border-0 rounded bg-[#223c83]">
                <p class="text-wrap pb-4">Welcome to CIPHIR, the dedicated admin panel for managing community hazards and infrastructure reports. Use this platform to efficiently track, address, and resolve issues reported by residents, ensuring a safer and well-maintained community. Log in to access your dashboard and start making a difference today.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Toggle Password Visibility
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("passwordInput");

    togglePassword.addEventListener("click", function () {
        // Toggle the type attribute
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);

        // Toggle the eye slash icon
        this.innerHTML =
            type === "password"
                ? '<i class="fas fa-eye-slash"></i>'
                : '<i class="fas fa-eye"></i>';
    });
</script>
@endsection
