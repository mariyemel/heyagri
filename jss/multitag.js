function MultiSelectTag(el, customs = { shadow: false, rounded: true }) {
    // Variables to store various DOM elements
    var element = null
    var options = null
    var customSelectContainer = null
    var wrapper = null
    var btnContainer = null
    var body = null
    var inputContainer = null
    var inputBody = null
    var input = null
    var button = null
    var drawer = null
    var ul = null
    var domParser = new DOMParser()

    // Initialize the multi-select tag
    init()

    // Function to initialize the multi-select tag
    function init() {
        element = document.getElementById(el)
        createElements()
        initOptions()
        enableItemSelection()
        setValues(false)

        // Add event listener for button click
        button.addEventListener('click', () => {
            if (drawer.classList.contains('hidden')) {
                initOptions()
                enableItemSelection()
                drawer.classList.remove('hidden')
                input.focus()
            }
        })

        // Add event listener for input keyup
        input.addEventListener('keyup', (e) => {
            initOptions(e.target.value)
            enableItemSelection()
        })

        // Add event listener for input keydown (for Backspace)
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && inputContainer.childElementCount > 1) {
                const child = body.children[inputContainer.childElementCount - 2].firstChild
                const option = options.find((op) => op.value == child.dataset.value)
                option.selected = false
                removeTag(child.dataset.value)
                setValues()
            }

        })

        // Add global click event listener to close the drawer when clicking outside
        window.addEventListener('click', (e) => {
            if (!customSelectContainer.contains(e.target)) {
                drawer.classList.add('hidden')
            }
        });

    }

    // Function to create DOM elements for the multi-select tag
    function createElements() {
        // Create custom elements
        options = getOptions();
        element.classList.add('hidden')

        // .multi-select-tag
        customSelectContainer = document.createElement('div')
        customSelectContainer.classList.add('mult-select-tag')

        // .container
        wrapper = document.createElement('div')
        wrapper.classList.add('wrapper')

        // body
        body = document.createElement('div')
        body.classList.add('body')
        if (customs.shadow) {
            body.classList.add('shadow')
        }
        if (customs.rounded) {
            body.classList.add('rounded')
        }

        // .input-container
        inputContainer = document.createElement('div')
        inputContainer.classList.add('input-container')

        // input
        input = document.createElement('input')
        input.classList.add('input')
        input.placeholder = `${customs.placeholder || 'Search...'}`

        inputBody = document.createElement('inputBody')
        inputBody.classList.add('input-body')
        inputBody.append(input)

        body.append(inputContainer)

        // .btn-container
        btnContainer = document.createElement('div')
        btnContainer.classList.add('btn-container')

        // button
        button = document.createElement('button')
        button.type = 'button'
        btnContainer.append(button)

        // SVG icon for the button
        const icon = domParser.parseFromString(`<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 21 6 15"></polyline></svg>`, 'image/svg+xml').documentElement
        button.append(icon)


        body.append(btnContainer)
        wrapper.append(body)

        // Drawer for displaying options
        drawer = document.createElement('div');
        drawer.classList.add(...['drawer', 'hidden'])
        if (customs.shadow) {
            drawer.classList.add('shadow')
        }
        if (customs.rounded) {
            drawer.classList.add('rounded')
        }
        drawer.append(inputBody)
        ul = document.createElement('ul');

        drawer.appendChild(ul)

        customSelectContainer.appendChild(wrapper)
        customSelectContainer.appendChild(drawer)

        // Place TailwindTagSelection after the element
        if (element.nextSibling) {
            element.parentNode.insertBefore(customSelectContainer, element.nextSibling)
        }
        else {
            element.parentNode.appendChild(customSelectContainer);
        }
    }

    // Function to initialize options based on user input
    function initOptions(val = null) {
        ul.innerHTML = ''
        for (var option of options) {
            if (option.selected) {
                !isTagSelected(option.value) && createTag(option)
            }
            else {
                const li = document.createElement('li')
                li.innerHTML = option.label
                li.dataset.value = option.value

                // For search
                if (val && option.label.toLowerCase().startsWith(val.toLowerCase())) {
                    ul.appendChild(li)
                }
                else if (!val) {
                    ul.appendChild(li)
                }
            }
        }
    }

    // Function to create a tag for a selected option
    function createTag(option) {
        // Create and show selected item as tag
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('item-container');
        const itemLabel = document.createElement('div');
        itemLabel.classList.add('item-label');
        itemLabel.innerHTML = option.label
        itemLabel.dataset.value = option.value
        const itemClose = new DOMParser().parseFromString(`<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="item-close-svg">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>`, 'image/svg+xml').documentElement

        itemClose.addEventListener('click', (e) => {
            const unselectOption = options.find((op) => op.value == option.value)
            unselectOption.selected = false
            removeTag(option.value)
            initOptions()
            setValues()
        })

        itemDiv.appendChild(itemLabel)
        itemDiv.appendChild(itemClose)
        inputContainer.append(itemDiv)
    }

    // Function to enable item selection in the dropdown
    function enableItemSelection() {
        // Add click listener to the list items
        for (var li of ul.children) {
            li.addEventListener('click', (e) => {
                options.find((o) => o.value == e.target.dataset.value).selected = true
                input.value = null
                initOptions()
                setValues()
                input.focus()
            })
        }
    }

    // Function to check if a tag is already selected
    function isTagSelected(val) {
        // If the item is already selected
        for (var child of inputContainer.children) {
            if (!child.classList.contains('input-body') && child.firstChild.dataset.value == val) {
                return true
            }
        }
        return false
    }

    // Function to remove a tag
    function removeTag(val) {
        // Remove selected item
        for (var child of inputContainer.children) {
            if (!child.classList.contains('input-body') && child.firstChild.dataset.value == val) {
                inputContainer.removeChild(child)
            }
        }
    }

    // Function to set the final values based on selected options
    function setValues(fireEvent = true) {
        // Update element final values
        selected_values = []
        for (var i = 0; i < options.length; i++) {
            element.options[i].selected = options[i].selected
            if (options[i].selected) {
                selected_values.push({ label: options[i].label, value: options[i].value })
            }
        }
        if (fireEvent && customs.hasOwnProperty('onChange')) {
            customs.onChange(selected_values)
        }
    }

    // Function to get the options from the original select element
    function getOptions() {
        // Map element options
        return [...element.options].map((op) => {
            return {
                value: op.value,
                label: op.label,
                selected: op.selected,
            }
        })
    }
}