var sum = document.getElementById("sum");
var price = document.getElementById("price");

var sliderWeight = document.getElementById("weight");
var weightValue = document.getElementById("weightValue");

var sliderCol = document.getElementById("col");
var colValue = document.getElementById("colValue");


if (weightValue!=null  && colValue!=null) {
    var priceDecor = document.getElementById("priceDecor").textContent;
    weightValue.value = sliderWeight.value;
    colValue.value = sliderCol.value;
    sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
    $('#sumInput').val(sum.innerHTML);
    sliderWeight.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        weightValue.value = this.value;
        sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
        $('#sumInput').val(sum.innerHTML);
    } 
    sliderCol.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        colValue.value = this.value;
        sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
        $('#sumInput').val(sum.innerHTML);
    }
    weightValue.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        if (Number(weightValue.value)>0 && Number(weightValue.value)<=10) {
            sliderWeight.value = this.value;
            sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
        }else{
            sliderWeight.value = 1;
            sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
        }

    }
    colValue.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        if(Number(colValue.value)>0 && Number(colValue.value)<=15){
            sliderCol.value = this.value;
            sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
        }else{
            sliderCol.value = 1;
            sum.innerHTML = Number(sliderWeight.value) * Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
        }
    }
}
if(colValue!=null && weightValue==null){
   colValue.value = sliderCol.value;
   sliderCol.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        colValue.value = this.value;
        sum.innerHTML = Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
        $('#sumInput').val(sum.innerHTML);
    }
    colValue.oninput = function() {
        var priceDecor = document.getElementById("priceDecor").textContent;
        if(Number(colValue.value)>0 && Number(colValue.value)<=15){
            sliderCol.value = this.value;
            sum.innerHTML = Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);                
        }else{
            sliderCol.value = 1;
            sum.innerHTML = Number(sliderCol.value) * Number(price.value)+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML); 
        }
    }}