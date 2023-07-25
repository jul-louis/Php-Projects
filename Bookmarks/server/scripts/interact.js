const modeToggle = document.getElementById('toggle-mode')
const modeToggleText = document.getElementById('toggle-text-mode')
const urlInput = document.getElementById('url_input')

let disabled = false;

modeToggle.addEventListener('change', ev => {
    disabled = !disabled
    if (disabled) {
        modeToggleText.innerHTML = "Enable URL Edit"
        hideElement(urlInput)
    } else {
        modeToggleText.innerHTML = "Disable URL Edit"
        showElement(urlInput)
    }
})

