@if(session('success'))
    <div class="w-full">
        <div id="successMessage" onclick="closeSuccess()" class="absolute right-4 bg-emerald-600 text-white text-xs text-center font-light py-2 px-4 border border-emerald-300 rounded-md z-10 cursor-pointer">
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="w-full">
        <div id="errorMessage" onclick="closeError()" class="absolute right-4 bg-rose-700 text-white text-xs text-center font-light py-2 px-4 border border-rose-200 rounded-md z-10 cursor-pointer">
            {{ session('error') }}
        </div>
    </div>
@endif

<script>
    function closeSuccess() {
        var myDiv = document.getElementById("successMessage");
        myDiv.style.display = "none";
    }

    function closeError() {
        var myDiv = document.getElementById("errorMessage");
        myDiv.style.display = "none";
    }
</script>