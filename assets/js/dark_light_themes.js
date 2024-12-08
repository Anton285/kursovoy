function ToggleTheme(theme) {
    let len_light = document.querySelectorAll('.light').length
    let len_light_text = document.querySelectorAll('.light_text').length
    if (theme == 'dark') {
        for (let i = 0; i < len_light; i++) {
            document.querySelectorAll('.light')[i].classList.add('dark')
        }
        for (let i = 0; i < len_light_text; i++) {
            document.querySelectorAll('.light_text')[i].classList.add('dark_theme_text')
        }
        document.querySelector('.light_body').classList.add('dark_body')
    } else if (theme == 'light') {
        for (let i = 0; i < len_light; i++) {
            document.querySelectorAll('.light')[i].classList.remove('dark')
        }
        for (let i = 0; i < len_light_text; i++) {
            document.querySelectorAll('.light_text')[i].classList.remove('dark_theme_text')
        }
        document.querySelector('.light_body').classList.remove('dark_body')
    }
}