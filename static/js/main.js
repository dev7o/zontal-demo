var passwordInput = document.getElementById('R_password');
var inputGroup = document.getElementById('input-group');
var inputtag = document.getElementById('input-tag');
var signup_form = document.getElementById('signup_form');
var signup_form_button = document.getElementById('sign_up_button');

if (passwordInput !== null) {
    passwordInput.addEventListener("keyup", (e) => {
        if (e.target.value !== '') {
            inputGroup.style.display = 'flex';
            inputtag.value = e.target.value;
        } else {
            inputGroup.style.display = 'none';
        }

    });
}

function verifyPassword() {
    // var pw = document.getElementById("pswd").value;  
    //check empty password field  
    if (passwordInput.value == "") {
        document.getElementById("message").innerHTML = "**Fill the password please!";
        return false;
    }

    //minimum password length validation  
    if (passwordInput.value.length < 8) {
        document.getElementById("message").innerHTML = "Password length must be at least 8 characters";
        return false;
    }

    //maximum length of password validation  
    if (pw.length > 15) {
        document.getElementById("message").innerHTML = "**Password length must not exceed 15 characters";
        return false;
    } else {
        alert("Password is correct");
    }
}


function toggleFullScreen() {
    var iframe = document.getElementById("my-iframe");
    if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
    } else if (iframe.webkitRequestFullscreen) { /* Safari */
        iframe.webkitRequestFullscreen();
    } else if (iframe.msRequestFullscreen) { /* IE11 */
        iframe.msRequestFullscreen();
    }
}

// var button_1 = document.querySelector(".cat-container .left");
// var button_2 = document.querySelector(".cat-container .right");

// var cat_container = document.querySelector(".cat-item-container");

// button_1.addEventListener("click", () => {
//   cat_container.scrollLeft -= 300;


//   if (cat_container.scrollLeft) {
//     button_2.classList.remove("hidden");
//   }

//   if (cat_container.scrollLeft == 0) {
//     button_1.classList.add("hidden")
//   }

// });

// button_2.addEventListener("click", () => {
//   cat_container.scrollLeft += 300;

//   let scrollWidth = cat_container.scrollWidth - cat_container.clientWidth;


//   if (cat_container.scrollLeft >= scrollWidth) {
//     button_2.classList.add("hidden");
//   }

//   if (cat_container.scrollLeft > 20) {
//     button_1.classList.remove("hidden")
//   }

// });

//   const close


// var open_Search = document.getElementById("open-search");
// if (open_Search !== null) {
//     open_Search.addEventListener("click", () => {
//         document.querySelector(".mobile-header").classList.toggle("active-search");
//     })
// }

// ========================================
// Dark Mode Toggle - Modern Implementation
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    const modeChangers = document.querySelectorAll('.mode-changer');

    // Function to set theme
    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    }

    // Toggle theme
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            setTheme('light');
        } else {
            setTheme('dark');
        }
    }

    // Add click event to all mode changers
    modeChangers.forEach(function (changer) {
        changer.addEventListener('click', function (e) {
            e.preventDefault();
            toggleTheme();
        });
    });
});

// ========================================
// Mobile Menu Toggle
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('.menu');
    const offcanvas = document.querySelector('.offcanvas');
    const closeButton = document.querySelector('.close-offcanvas');
    const blurOverlay = document.querySelector('.blur-overlay');

    if (menuButton && offcanvas) {
        menuButton.addEventListener('click', function () {
            offcanvas.classList.add('active');
        });
    }

    if (closeButton && offcanvas) {
        closeButton.addEventListener('click', function () {
            offcanvas.classList.remove('active');
        });
    }

    if (blurOverlay && offcanvas) {
        blurOverlay.addEventListener('click', function () {
            offcanvas.classList.remove('active');
        });
    }
});

// ========================================
// Dropdown Menu Toggle (Mobile)
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function (dropdown) {
        const link = dropdown.querySelector('a');
        const content = dropdown.querySelector('.dropdown-content');

        if (link && content) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                content.classList.toggle('active-dropdown');
            });
        }
    });
});

// ========================================
// Search Toggle (Mobile)
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    const openSearch = document.getElementById('open-search');
    const closeSearch = document.getElementById('close-search');
    const mobileHeader = document.querySelector('.mobile-header');

    if (openSearch && mobileHeader) {
        openSearch.addEventListener('click', function () {
            mobileHeader.classList.add('active-search');
        });
    }

    if (closeSearch && mobileHeader) {
        closeSearch.addEventListener('click', function () {
            mobileHeader.classList.remove('active-search');
        });
    }
});

// ========================================
// Smooth Scroll Animations
// ========================================
document.addEventListener('DOMContentLoaded', function () {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, index) {
            if (entry.isIntersecting) {
                entry.target.style.setProperty('--index', index);
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    const boxes = document.querySelectorAll('.box');
    boxes.forEach(function (box) {
        observer.observe(box);
    });
});
