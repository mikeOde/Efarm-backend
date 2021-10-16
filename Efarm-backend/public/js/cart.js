    $("document").ready(function(){
    var quantity;
    

    $("#minus").click(function(){
        minusOne();
    })

    $("#plus").click(function(){
        plusOne();
    })

    function minusOne(){
        quantity = $("#quantity").val();
        if(quantity>0){
            quantity -= 1;
            console.log(quantity);
            $("#quantity").html(quantity);
        }
        quantity = quantity -1;
        console.log(quantity);
        $("#quantity").html(quantity);
    }

    function plusOne(){
        
        quantity = $("#quantity").val();
    
        quantity = quantity + 1;
        $("#quantity").html(quantity);
    }
})