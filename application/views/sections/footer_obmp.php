
<script>
    $("#datepickerM").datepicker();
</script>  
<script>

    $(function () {
// Dal 
        $("#preno_dal_c").datepicker({
            defaultDate: "",
            showButtonPanel: true,
            currentText: "Today",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#preno_al_c").datepicker("option", "minDate", selectedDate);

            }
        });
// Al
        $("#preno_al_c").datepicker({
            defaultDate: "+1d",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });


    });
</script>


<div class="show-for-large-up"> 

<script>
   $(window).scroll(function () {
      $("#riepilogo").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft": ($(window).scrollLeft()) + "px"}, "slow");
  });
</script>

</div>