let count_sliders = document.getElementsByClassName('slider').length;
let counters_arr = [];
for (let i = 0; i < count_sliders; i++) {
    counters_arr[i] = 0;
}

function ClickForward(th) {
    let number_slider = th.id.slice(2, 3);
    let id_slide = 'slider' + number_slider;
    let counter_slide = counters_arr[number_slider - 1];
    if (counter_slide < ((document.querySelectorAll('#'+ id_slide + ' .item').length / 3) - 1)) {
        counters_arr[number_slider - 1] += 1;
        let ml_slide = 1080 * counters_arr[number_slider - 1];
        document.getElementById(id_slide).style.marginLeft = '-' + ml_slide + 'px';
    }
}

function ClickBack(th) {
    let number_slider = th.id.slice(2, 3);
    let id_slide = 'slider' + number_slider;
    let counter_slide = counters_arr[number_slider - 1];
    if (counter_slide > 0) {
        counters_arr[number_slider - 1] -= 1;
        let ml_slide = 1080 * counters_arr[number_slider - 1];
        document.getElementById(id_slide).style.marginLeft = '-' + ml_slide + 'px';
    }
}
