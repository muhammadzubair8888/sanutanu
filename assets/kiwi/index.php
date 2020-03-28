<?php
	$curl_handle=curl_init();


	//curl_setopt($curl_handle,CURLOPT_URL,'https://api.skypicker.com/aggregation_flights?fly_from=CZ&fly_to=porto&v=3&date_from=08/08/2019&date_to=08/09/2019&max_fly_duration=6&flight_type=oneway&one_for_city=0&one_per_date=1&adults=1&children=0&infants=0&partner=picky&partner_market=us&curr=EUR&locale=en&limit=30&sort=price&asc=1&xml=0');
	
	//curl_setopt($curl_handle,CURLOPT_URL,'https://booking-api.skypicker.com/api/v0.1/check_flights?v=2&booking_token=TjFsU9KOyjpEDqm5dNSrO1ZjuRMVMgZrERrSppD325T6P8+P9w468E+3gYirNKm0xjFEaQ8brFkJXYHcFnHHQP5fINbkDjCTreeWig4WZ7B4fBYYSUgmpu0Cq8+F75sB1L9aQ+cDGm5LObGbRYN0pwUDk5LuVOHkDPT1Qmo6XhmrtXw4mLqlylxVlpY+8jS2/eBYqLA7CPIQyfcUqPhx/F26+QR/TnuLRGUvd7cpYS88pyKmqcUiqIMz9FvuwQTxaTrPz8tES/e8I0br2Ukn4YrIvIX3jo30Rxwts1D64ZSjKrZne87kU+PYeizs0RTIYiVu5Zux/kNlWRTw4GuQENl5maQY+cvTyNeEmsSFNAnncJjC9hZeaAE665S2m17ZkQoH5qOydbZF321QBC3qXDzTZS6JFct/tS48NzvLd9u9vfull8wo3cBVl29GyOpSjdY+NJ3UzagFZOpNCT+tjIgElPELVzuzMAy7sqqvGk5b0SAO0D+xBuiOg3NIggZfHyZ+clsgRcMiTj33hVaSuL9PLtkvHV3xMgufu6AdAnVUQdv4qsWH3S4aXckyEVSpuVH1VxzYPm1ikRrUSup8lV/xJsITBR6v/IlkwTuWn6S4oasaojMW6sjrPrZObC0xtQ7jZ53BYcnYD+RGXeT6pTBfWjjjlgq45g5Hi2ta9fo=&bnum=3&pnum=2&affily=picky_{market}&currency=USD&adults=1&children=0&infants=1');
	
	curl_setopt($curl_handle,CURLOPT_URL,'https://api.skypicker.com/flights?flyFrom=PRG&to=LGW&dateFrom=18/11/2020&dateTo=12/12/2020&partner=q9sYXyFYh8ustAAvFHHXtSsB8mVgW1a4&v=3');
	


	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	// if (empty($buffer)){
	//   print "Nothing returned from url.<p>";
	// }
	// else{
	//   print $buffer;
	// }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>


    <style type="text/css">
    	.form-group {
  margin-bottom: 20px;
}

.control-label {
  display: block;
}

.autocomplete-wrapper {
  position: relative;
}
.autocomplete-wrapper input {
  width: 100%;
}

.autocomplete-results {
  position: absolute;
  background: white;
  z-index: 1;
  top: 100%;
  left: 0;
  font-size: 13px;
  border: solid 1px #ddd;
  border-top-width: 0;
  border-bottom-color: #ccc;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.autocomplete-result {
  padding: 12px 15px;
  border-bottom: solid 1px #eee;
  cursor: pointer;
}

.autocomplete-result:last-child {
  border-bottom-width: 0;
}

.autocomplete-location {
  opacity: .8;
  font-size: smaller;
}

.autocomplete-results[data-highlight='0'] > :nth-child(1) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='1'] > :nth-child(2) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='2'] > :nth-child(3) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='3'] > :nth-child(4) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='4'] > :nth-child(5) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='5'] > :nth-child(6) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='6'] > :nth-child(7) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

.autocomplete-results[data-highlight='7'] > :nth-child(8) {
  color: white;
  background: #26C9FF;
  border-bottom-color: #26C9FF;
  outline: solid 1px #00b6f2;
}

    </style>
  </head>
  <body>
    <div class="container mt-5">
    	<div class="card card-body">
    		<form action="/kiwi/search_flight.php" method="GET">
		    	<div class="form-row">
		    		<div class="col-md-6">
		    			<div class="form-group">
						    <label for="from">From</label>
						    <input type="text" class="form-control form-control-lg autocomplete" id="from" name="from" aria-describedby="fromHelp" placeholder="Departure">
						    <small id="fromHelp" class="form-text text-muted">Select a departure location</small>
						 </div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
						    <label for="to">To</label>
						    <!-- <input type="text" class="form-control form-control-lg autocompleteTo" id="to" name="to" aria-describedby="toHelp" placeholder="Destination"> -->
						    <select class="form-control" id="to" name="to">
						      <option value="" selected>Select a destination</option>
						      <option value="LON">LON</option>
						      <option value="LTN">LTN</option>
						      <option value="MAN">MAN</option>
						    </select>
						    <small id="toHelp" class="form-text text-muted">Select a destination location</small>
						 </div>
		    		</div>
		    	</div>

		    	<div class="form-row">
		    		<div class="col-md-6">
		    			<div class="form-group">
						    <label for="dateFrom">Date From</label>
						    <input type="date" class="form-control form-control-lg" id="dateFrom" name="dateFrom" aria-describedby="dateFromHelp">
						    <small id="dateFromHelp" class="form-text text-muted">Select a departure date</small>
						 </div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group">
						    <label for="dateTo">Date To</label>
						    <input type="date" class="form-control form-control-lg" id="dateTo" name="dateTo" aria-describedby="dateToHelp">
						    <small id="dateToHelp" class="form-text text-muted">Select an arrival date</small>
						 </div>
		    		</div>
		    	</div>
			  

			  <button type="submit" class="btn btn-primary btn-lg">Find Flights</button>
			</form>
    	</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.16.1/lodash.min.js"></script>
    <script src="https://unpkg.com/fuse.js@2.5.0/src/fuse.min.js"></script>
    <script src="https://screenfeedcontent.blob.core.windows.net/html/airports.js"></script>


    <script>
    	var options = {
		  shouldSort: true,
		  threshold: 0.4,
		  maxPatternLength: 32,
		  keys: [{
		    name: 'iata',
		    weight: 0.5
		  }, {
		    name: 'name',
		    weight: 0.3
		  }, {
		    name: 'city',
		    weight: 0.2
		  }]
		};

		var fuse = new Fuse(airports, options)


		var ac = $('.autocomplete')
		  .on('click', function(e) {
		    e.stopPropagation();
		  })
		  .on('focus keyup', search)
		  .on('keydown', onKeyDown);

		var wrap = $('<div>')
		  .addClass('autocomplete-wrapper')
		  .insertBefore(ac)
		  .append(ac);

		var list = $('<div>')
		  .addClass('autocomplete-results')
		  .on('click', '.autocomplete-result', function(e) {
		    e.preventDefault();
		    e.stopPropagation();
		    selectIndex($(this).data('index'));
		  })
		  .appendTo(wrap);

		$(document)
		  .on('mouseover', '.autocomplete-result', function(e) {
		    var index = parseInt($(this).data('index'), 10);
		    if (!isNaN(index)) {
		      list.attr('data-highlight', index);
		    }
		  })
		  .on('click', clearResults);

		function clearResults() {
		  results = [];
		  numResults = 0;
		  list.empty();
		}

		function selectIndex(index) {
		  if (results.length >= index + 1) {
		    ac.val(results[index].iata);
		    clearResults();
		  }  
		}

		var results = [];
		var numResults = 0;
		var selectedIndex = -1;

		function search(e) {
		  if (e.which === 38 || e.which === 13 || e.which === 40) {
		    return;
		  }
		  
		  if (ac.val().length > 0) {
		    results = _.take(fuse.search(ac.val()), 7);
		    numResults = results.length;
		    
		    var divs = results.map(function(r, i) {
		        return '<div class="autocomplete-result" data-index="'+ i +'">'
		             + '<div><b>'+ r.iata +'</b> - '+ r.name +'</div>'
		             + '<div class="autocomplete-location">'+ r.city +', '+ r.country +'</div>'
		             + '</div>';
		     });
		    
		    selectedIndex = -1;
		    list.html(divs.join(''))
		      .attr('data-highlight', selectedIndex);

		  } else {
		    numResults = 0;
		    list.empty();
		  }
		}

		function onKeyDown(e) {
		  switch(e.which) {
		    case 38: // up
		      selectedIndex--;
		      if (selectedIndex <= -1) {
		        selectedIndex = -1;
		      }
		      list.attr('data-highlight', selectedIndex);
		      break;
		    case 13: // enter
		      selectIndex(selectedIndex);
		      break;
		    case 9: // enter
		      selectIndex(selectedIndex);
		      e.stopPropagation();
		      return;
		    case 40: // down
		      selectedIndex++;
		      if (selectedIndex >= numResults) {
		        selectedIndex = numResults-1;
		      }
		      list.attr('data-highlight', selectedIndex);
		      break;

		    default: return; // exit this handler for other keys
		  }
		  e.stopPropagation();
		  e.preventDefault(); // prevent the default action (scroll / move caret)
		}
    </script>



    <script>
    	var optionsTwo = {
		  shouldSort: true,
		  threshold: 0.4,
		  maxPatternLength: 32,
		  keys: [{
		    name: 'iata',
		    weight: 0.5
		  }, {
		    name: 'name',
		    weight: 0.3
		  }, {
		    name: 'city',
		    weight: 0.2
		  }]
		};

		var fuseTwo = new Fuse(airports, optionsTwo)


		var acTwo = $('.autocompleteTo')
		  .on('click', function(e) {
		    e.stopPropagation();
		  })
		  .on('focus keyup', searchTwo)
		  .on('keydown', onKeyDownTwo);

		var wrapTwo = $('<div>')
		  .addClass('autocomplete-wrapper')
		  .insertBefore(acTwo)
		  .append(acTwo);

		var listTwo = $('<div>')
		  .addClass('autocomplete-results')
		  .on('click', '.autocomplete-result', function(e) {
		    e.preventDefault();
		    e.stopPropagation();
		    selectIndexTwo($(this).data('index'));
		  })
		  .appendTo(wrapTwo);

		$(document)
		  .on('mouseover', '.autocomplete-result', function(e) {
		    var index = parseInt($(this).data('index'), 10);
		    if (!isNaN(index)) {
		      listTwo.attr('data-highlight', index);
		    }
		  })
		  .on('click', clearResultsTwo);

		function clearResultsTwo() {
		  results = [];
		  numResults = 0;
		  listTwo.empty();
		}

		function selectIndexTwo(index) {
		  if (results.length >= index + 1) {
		    acTwo.val(results[index].iata);
		    clearResultsTwo();
		  }  
		}

		var results = [];
		var numResults = 0;
		var selectedIndex = -1;

		function searchTwo(e) {
		  if (e.which === 38 || e.which === 13 || e.which === 40) {
		    return;
		  }
		  
		  if (acTwo.val().length > 0) {
		    results = _.take(fuseTwo.searchTwo(acTwo.val()), 7);
		    numResults = results.length;
		    
		    var divs = results.map(function(r, i) {
		        return '<div class="autocomplete-result" data-index="'+ i +'">'
		             + '<div><b>'+ r.iata +'</b> - '+ r.name +'</div>'
		             + '<div class="autocomplete-location">'+ r.city +', '+ r.country +'</div>'
		             + '</div>';
		     });
		    
		    selectedIndex = -1;
		    listTwo.html(divs.join(''))
		      .attr('data-highlight', selectedIndex);

		  } else {
		    numResults = 0;
		    listTwo.empty();
		  }
		}

		function onKeyDownTwo(e) {
		  switch(e.which) {
		    case 38: // up
		      selectedIndex--;
		      if (selectedIndex <= -1) {
		        selectedIndex = -1;
		      }
		      listTwo.attr('data-highlight', selectedIndex);
		      break;
		    case 13: // enter
		      selectIndexTwo(selectedIndex);
		      break;
		    case 9: // enter
		      selectIndexTwo(selectedIndex);
		      e.stopPropagation();
		      return;
		    case 40: // down
		      selectedIndex++;
		      if (selectedIndex >= numResults) {
		        selectedIndex = numResults-1;
		      }
		      listTwo.attr('data-highlight', selectedIndex);
		      break;

		    default: return; // exit this handler for other keys
		  }
		  e.stopPropagation();
		  e.preventDefault(); // prevent the default action (scroll / move caret)
		}
    </script>
  </body>
</html>