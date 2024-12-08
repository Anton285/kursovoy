const radioButtons = document.querySelectorAll('input[name="feedback_rating"]');
for (const radioButton of radioButtons) {
    radioButton.addEventListener('change', showSelected);
}

function showSelected(e) {
    if (this.checked) {
        let number_star = this.id.slice(5, 6);
        for (let i= 1; i <= number_star; i++) {
            document.querySelector('#black'+ i).style.display = 'none';
            document.querySelector('#yellow'+ i).style.display = 'block';
        }
        for (let i= 5; i > number_star; i--) {
            document.querySelector('#black'+ i).style.display = 'block';
            document.querySelector('#yellow'+ i).style.display = 'none';
        }
        document.querySelector('#rat_star').textContent = number_star;
    }
}