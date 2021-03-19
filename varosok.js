function kereses() {
    var bemenet = $("#beKeres").val();
    $.ajax({
        type:"GET",
        url:"getadatok.php?bemenet="+bemenet,
        success:function(valasz){
            console.log(valasz);
            $("#valasz").html(valasz);
        },
        error:function(){
            console.log("Hiba az adatok lekérésekor");
        }
    });
}

$(function(){
    $("#beKeres").keyup(kereses);
});