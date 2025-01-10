const searchInput = document.getElementById("searchInput");

// Suggestions for the placeholder animation
const suggestions = [
    "carrot",
    "potato",
    "tomato",
    "onion",
    "spinach",
    "broccoli",
    "cucumber",
    "cauliflower",
    "peas",
    "zucchini",
    "bell pepper",
    "cabbage",
    "lettuce",
    "garlic",
    "ginger",
    "eggplant",
    "mushroom",
    "pumpkin",
    "radish",
    "beetroot",
    "sweet corn",
    "chili",
    "okra",
    "celery",
    "parsley",
    "kale",
    "asparagus",
    "turnip",
    "brussels sprouts",
    "leek",
    "fennel",
    "artichoke",
    "bok choy",
    "arugula",
    "watercress"
];


let currentIndex = 0;

function animatePlaceholder() {
    searchInput.placeholder = `Search "${suggestions[currentIndex]}"`;
    currentIndex = (currentIndex + 1) % suggestions.length; // Loop back to the first suggestion
}

// Change placeholder every 2 seconds
setInterval(animatePlaceholder, 2000);