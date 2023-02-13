(function($){
	jQuery(document).ready(function() {	

		
		
		(function () {
		  const second = 1000,
		        minute = second * 60,
		        hour = minute * 60,
		        day = hour * 24;

		  //I'm adding this section so I don't have to keep updating this pen every year :-)
		  //remove this if you don't need it
		  let today = new Date(),
		      dd = String(today.getDate()).padStart(2, "0"),
		      mm = String(today.getMonth() + 1).padStart(2, "0"),
		      yyyy = today.getFullYear(),
		      nextYear = yyyy + 1,
		      dayMonth = "02/30/",
		      birthday = dayMonth + yyyy;
		  
		  today = mm + "/" + dd + "/" + yyyy;
		  if (today > birthday) {
		    birthday = dayMonth + nextYear;
		  }
		  //end
		  
		  const countDown = new Date(birthday).getTime(),
		      x = setInterval(function() {    

		        const now = new Date().getTime(),
		              distance = countDown - now;

		        document.getElementById("days").innerText = Math.floor(distance / (day)),
		          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
		          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
		          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

		        //do something later when date is reached
		        if (distance < 0) {
		          document.getElementById("headline").innerText = "It's my birthday!";
		          document.getElementById("countdown").style.display = "none";
		          document.getElementById("content").style.display = "block";
		          clearInterval(x);
		        }
		        //seconds
		      }, 0)
		  }());


		var $incrementInputs = $('.js-increment-group')

        $incrementInputs.each(function() {
          $this = $(this)
          
          var $buttons = $this.find('.js-increment-button')
            , $input = $this.find('.js-increment-input')
            , interval = $input.data('interval') || 1
            , prefix = $input.data('prefix') || ''
            , upperLimit = $input.data('upper-limit') || Infinity
          
          $buttons.on('touchend click', function(e) {
            
            e.stopPropagation()
            e.preventDefault()

            var direction = $(this).data('direction')
              , currentVal = $input.val().replace(/[^0-9\.\-]+/g, '') // Strip any non-numeric characters, allowing for negative or decimal numbers
              , newVal = 0
            
            if (isNaN(currentVal)) {
              $input.val(prefix + '0')
            } else {

              if (direction === 'dec') {
                newVal = +currentVal - interval
              } else if (direction === 'inc') {
                newVal = +currentVal + interval
              }

              // Keep things positive
              newVal = (newVal > 0) ? newVal : 0
              
              // Don't exceed upper limits
              newVal = (newVal < upperLimit) ? newVal : upperLimit

              $input.val(prefix + newVal)
            }

          })

        })

		

				
		
		
		
		
		
		
		
		
	});
})(jQuery);