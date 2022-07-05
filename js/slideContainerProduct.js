var price = document.getElementById("price").textContent;
var sum = document.getElementById("sum");
var sumInput = document.getElementById("sumInput");
var f = $('#sumInput').value;

var sliderWeight = document.getElementById("weight");
var weightValue = document.getElementById("weightValue");

var sliderCol = document.getElementById("col");
var colValue = document.getElementById("colValue");


if (weightValue!=null  && colValue!=null) {

    /*weightValue.value = sliderWeight.value;
    colValue.value = sliderCol.value;*/
    
    
    sliderWeight.oninput = function() {
        weightValue.value = this.value;
        sum.innerHTML = sliderWeight.value * sliderCol.value * price;
        sumInput.value = sum.innerHTML;
    } 
    sliderCol.oninput = function() {
        colValue.value = this.value;
        sum.innerHTML = sliderWeight.value * sliderCol.value * price;
        sumInput.value = sum.innerHTML;
    }

    weightValue.oninput = function() {
        if (Number(weightValue.value)>0 && Number(weightValue.value)<=10) {
            sliderWeight.value = this.value;
            sum.innerHTML = sliderWeight.value * sliderCol.value * price;
            sumInput.value = sum.innerHTML;
        }else{
            /*weightValue.value = 1;*/
            sliderWeight.value = 1;
            sum.innerHTML = sliderWeight.value * sliderCol.value * price;
            sumInput.value = sum.innerHTML;/*
            alert('sdfvgggsbvs');*/
        }

    }
    colValue.oninput = function() {
        if(Number(colValue.value)>0 && Number(colValue.value)<=15){
            sliderCol.value = this.value;
            sum.innerHTML = sliderWeight.value * sliderCol.value * price;
            sumInput.value = sum.innerHTML;            
        }else{
            /*colValue.value = 1;*/
            sliderCol.value = 1;
            sum.innerHTML = sliderWeight.value * sliderCol.value * price;
            sumInput.value = sum.innerHTML;/*
            alert('sdfvsdvs');*/
        }
    }
}



if(colValue!=null && weightValue==null){
   /*colValue.value = sliderCol.value;*/
    sum.innerHTML = sliderCol.value * price;
    sliderCol.oninput = function() {
        colValue.value = this.value;
        sum.innerHTML = this.value * price;
        sumInput.value = sum.innerHTML;
    }
    colValue.oninput = function() {
        if(Number(colValue.value)>0 && Number(colValue.value)<=15){
            sliderCol.value = this.value;
            sum.innerHTML = sliderCol.value * price;
            sumInput.value = sum.innerHTML;            
        }else{
            /*colValue.value = 1;*/
            sliderCol.value = 1;
            sum.innerHTML = sliderCol.value * price;
            sumInput.value = sum.innerHTML;/*
            alert('sdfvsdvs');*/
        }
    }
}


