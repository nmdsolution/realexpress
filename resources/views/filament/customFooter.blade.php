<footer class="fixed bottom-0 left-0 z-20 w-full p-1 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024
        <a href="#" class="hover:underline">Meuilleur logiciel de transport™</a>. All Rights Reserved.by NGUEKI MOISE DONALD & TCHOUMO ALAIN </span>
    <div id="model-clock">
        <div id="clock-display"></div>
    </div>
</footer>
<style>
/* New styles for clock positioning */
#model-clock {
    position: absolute;
    left: 50%;
    /*  Center the clock horizontally */
    /*transform: translate(-50%, -50%);  Adjust position based on offset */
}


</style>
<script>
    // Function to display the current time in Douala, Africa time zone
    function displayDoualaTime() {
        const now = new Date().toLocaleTimeString('fr-CM', { timeZone: 'Africa/Douala' });
        document.getElementById('clock-display').textContent = now;
    }

    // Update clock every second
    setInterval(displayDoualaTime, 1000);

</script>
