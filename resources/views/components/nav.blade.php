<nav class="bg-white shadow p-4 flex justify-between">
    <div><a href="{{ route('events.index') }}" class="font-bold">Event Manager</a></div>
    <div>
        @auth
            <span class="mr-4">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">@csrf <button>Logout</button></form>
        @else
            <a href="{{ route('login') }}" class="mr-2">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</nav>
