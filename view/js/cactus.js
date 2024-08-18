import {
  setCustomProperty,
  incrementCustomProperty,
  getCustomProperty,
} from "./updateCustomProperty.js"

const SPEED = 0.05
const CACTUS_INTERVAL_MIN = 500
const CACTUS_INTERVAL_MAX = 2000
const worldElem = document.querySelector("[data-world]")
let morseCode = []
let morseIndex = 0
let nextCactusTime = 0
let cactusCreationInterval = 0

export function setupCactus() {
  fetchMorseCode(function(code) {
    morseCode = code.split(' ')
    console.log('Morse Code:', morseCode); // Debugging line
    morseIndex = 0
    nextCactusTime = getNextInterval()
    cactusCreationInterval = getCactusCreationInterval()
    document.querySelectorAll("[data-cactus]").forEach(cactus => {
      cactus.remove()
    })
  })
}

export function updateCactus(delta, speedScale) {
  document.querySelectorAll("[data-cactus]").forEach(cactus => {
    incrementCustomProperty(cactus, "--left", delta * speedScale * SPEED * -1)
    if (getCustomProperty(cactus, "--left") <= -100) {
      cactus.remove()
    }
  })

  nextCactusTime -= delta
  if (nextCactusTime <= 0 && morseIndex < morseCode.length) {
    processMorseCodeSymbol(morseCode[morseIndex])
    morseIndex++
    if (morseIndex < morseCode.length) {
      nextCactusTime = cactusCreationInterval / speedScale
    }
  }
}

export function getCactusRects() {
  return [...document.querySelectorAll("[data-cactus]")].map(cactus => {
    return cactus.getBoundingClientRect()
  })
}

function processMorseCodeSymbol(symbol) {
  // Split the symbol into individual characters
  for (let char of symbol) {
    console.log('Processing Character:', char); // Debugging line
    if (char === '.') {
      createCactus()
    } else if (char === '-') {
      indicateDash() // New function to handle dash
    }
  }
}

function createCactus() {
  console.log('Creating Cactus'); // Debugging line

  const cactus = document.createElement("img")
  cactus.dataset.cactus = true
  cactus.src = "imgs/cactus.png" // Ensure this path is correct and image exists
  cactus.classList.add("cactus")

  // Scale down the cactus using CSS transform
  cactus.style.transform = "scale(0.5)"; // Adjust the scale value as needed

  setCustomProperty(cactus, "--left", 100) // Ensure this is setting the position correctly
  worldElem.append(cactus)

  // Debugging to ensure the cactus is added to the DOM
  console.log('Cactus Element:', cactus);
}

function indicateDash() {
  console.log('Indicating Dash'); // Debugging line

  const cloud = document.createElement("img")
  cloud.dataset.cactus = true // Using the same data attribute to keep the behavior consistent
  cloud.src = "imgs/cloud.png" // Path to the cloud image
  cloud.classList.add("cactus") // Reusing the 'cactus' class for similar behavior

  // Scale down the cloud using CSS transform
  cloud.style.transform = "scale(0.5)"; // Adjust the scale value as needed

  setCustomProperty(cloud, "--left", 100) // Set the initial position correctly
  worldElem.append(cloud)

  // Debugging to ensure the cloud is added to the DOM
  console.log('cloud Element:', cloud);
}



function randomNumberBetween(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min)
}

function getNextInterval() {
  return randomNumberBetween(CACTUS_INTERVAL_MIN, CACTUS_INTERVAL_MAX)
}

function getCactusCreationInterval() {
  // Calculate the time between creating cacti based on the number of dots in Morse code
  return randomNumberBetween(CACTUS_INTERVAL_MIN, CACTUS_INTERVAL_MAX)
}

function fetchMorseCode(callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', '/utils/Morse_Code_Generator.php', true); // Updated to a relative path
  xhr.onload = function() {
    if (xhr.status >= 200 && xhr.status < 300) {
      const data = JSON.parse(xhr.responseText);
      console.log('Fetched Morse Code:', data.morseCode); // Debugging line
      callback(data.morseCode || '');
    } else {
      console.error('Failed to fetch Morse code:', xhr.statusText);
      callback('');
    }
  };
  xhr.onerror = function() {
    console.error('Request failed');
    callback('');
  };
  xhr.send();
}
