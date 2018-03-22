<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="row">
  <div class="large-4 columns">         
    <form>
           <fieldset>
          <label>Pick a fruit:</label>
                <select name="Fruit" id="sel" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                  <option value="0">Apple</option>
                  <option value="1">Orange</option>
                  <option value="2">Bananna</option>
              </select>

              <div id="PIERWSZY" style="display:none;">
                  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
              </div>

            <div id="DRUGI" style="display:none;">
                  YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY
              </div>
           </fieldset>
    </form>
  </div>
</div>

<script>
 function show(aval) {
    if (aval == "0") {
    PIERWSZY.style.display='inline-block';
    
	DRUGI.style.display='none';
	
	Form.fileURL.focus();
    } 
    else if (aval == "1") {
	DRUGI.style.display='inline-block';
    
    PIERWSZY.style.display='none';
	
	Form.fileURL.focus();
    }
	else
		PIERWSZY.style.display='none';
		DRUGI.style.display='none';
  }
  </script>
  
  <script>
  

//$( "#myselect" ).val();
  
  //$( "#sel" ).click(function() {
 // var a = $( "#sel" ).val();
 // if (a="PIERWSZY"){
 // $( "#PIERWSZY" ).hide();}
  </script>