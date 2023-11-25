document.addEventListener('DOMContentLoaded', function() {
    async function updateQuote() {
        // Fetch a random quote from the Quotable API
        const response = await fetch("https://api.quotable.io/random");
        const data = await response.json();
        if (response.ok) {
        // Update DOM elements
        document.getElementById('quote').innerHTML = `"${data.content}"`;
        document.getElementById('author').innerHTML = `- ${data.author}`;
        } else {
        quote.textContent = "An error occured";
        }
    }
    updateQuote();
});