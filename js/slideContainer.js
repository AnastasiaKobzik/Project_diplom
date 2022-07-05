var slider = document.getElementById("myRange");
var output = document.getElementById("demo");

var slider1 = document.getElementById("myRange1");
var output1 = document.getElementById("demo1");


output.value = slider.value;
slider.oninput = function() {
    output.value = this.value;
    if (Number(output.value) > Number(output1.value)) {
        output.value = Number(output1.value)-1;
        slider.value=output.value;
    }
}
output.oninput = function(){
    slider.value = this.value;
    if (Number(slider.value) > Number(slider1.value)) {
        slider.value = Number(slider1.value)-1;
        output.value = slider.value;
    }
    if (Number(output.value) < 4) {
        output.value = 5;
        slider.value = 5;
    }
}



output1.value = slider1.value;
slider1.oninput = function() {
    output1.value = this.value;
    if (Number(output.value) > Number(output1.value)) {
        output1.value = Number(output.value)+1;
        slider1.value=output1.value;
    }
}
output1.oninput = function(){
    slider1.value = this.value;
    if (Number(slider.value) > Number(slider1.value)) {
        slider1.value = Number(slider.value)+1;
        output1.value = slider1.value;
    }
    if (Number(output1.value) < 4) {
        output1.value = 100;
        slider1.value = 100;
    }
}
