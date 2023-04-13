<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Scandiweb Application - Add</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="utf-8">
  </head>
  <body>
    <script>
      function perfChange(display_id = 0) {
        var make_id = "#" + display_id;
        $(".hideMe").hide();
        $(make_id).show();
      }

      function validateForm() {
        var valid = true;
        var sku = $('#sku').val().trim();
        if (sku == '') {
          $('#skuEmpty').html('SKU field is required');
          valid = false;
        } else {
          $('#skuEmpty').html('');
        }
        var name = $('#name').val().trim();
        console.log(name);
        if (name == '') {
          $('#nameEmpty').html('Name field is required');
          valid = false;
        } else {
          $('#nameEmpty').html('');
        }
        var price = $('#price').val().trim();
        if (price == '') {
          $('#priceErr').html('Price field is required');
          valid = false;
        } else if (isNaN(price)) {
          $('#priceErr').html('Price field must be a number');
          valid = false;
        } else {
          $('#priceErr').html('');
        }
        var productType = $('#productType').val();
        if (productType == '') {
          $('#selectEmpty').html('Please select a product type');
          valid = false;
        } else {
          $('#selectEmpty').html('');
        }
        if (productType == 1) {
          var size = $('#size').val().trim();
          if (size == '') {
            $('#sizeErr').html('Size field is required');
            valid = false;
          } else if (isNaN(size)) {
            $('#sizeErr').html('Size field must be a number');
            valid = false;
          } else {
            $('#sizeErr').html('');
          }
        }
        if (productType == 2) {
          var height = $('#height').val().trim();
          var width = $('#width').val().trim();
          var length = $('#length').val().trim();
          if (height == '') {
            $('#heightErr').html('Height field is required.');
            valid = false;
          } else if (isNaN(height)) {
            $('#heightErr').html('Height field must be a number');
            valid = false;
          } else {
            $('#heightErr').html('');
          }
          if (width == '') {
            $('#widthErr').html('Width field is required');
            valid = false;
          } else if (isNaN(width)) {
            $('#widthErr').html('Width field must be a number');
            valid = false;
          } else {
            $('#widthErr').html('');
          }
          if (length == '') {
            $('#lengthErr').html('Length field is required');
            valid = false;
          } else if (isNaN(length)) {
            $('#lengthErr').html('Length field must be a number');
            valid = false;
          } else {
            $('#lengthErr').html('');
          }
        }
        if (productType == 3) {
          var weight = $('#weight').val().trim();
          if (weight == '') {
            $('#weightErr').html('Weight field is required');
            valid = false;
          } else if (isNaN(weight)) {
            $('#weightErr').html('Weight field must be a number');
            valid = false;
          } else {
            $('#weightErr').html('');
          }
        }
        return valid;
      }

      function getValues() {
        if (validateForm()) {
          var sku = name = price = size = weight = dimension = "NULL";
          sku = $('#sku').val().trim();
          name = $('#name').val().trim();
          console.log(name);
          price = $('#price').val().trim();
          var controller = $('#productType').val();
          if (controller == 2) {
            var height = $('#height').val().trim();
            var width = $('#width').val().trim();
            var length = $('#length').val().trim();
            dimension = height + "x" + width + "x" + length;
          } else if (controller == 1) {
            size = $('#size').val().trim();
          } else if (controller == 3) {
            weight = $('#weight').val().trim();
          }
          $.ajax({
            url: 'InsertIntoTableCaller.php',
            type: 'post',
            data: {
              action: 'insertIntoDb',
              sku: sku,
              name: name,
              price: price,
              size: size,
              weight: weight,
              dimension: dimension
            },
            success: function(response) {
              window.location.href = "index.php"
            },
            error: function(xhr, status, error) {
              console.log(error);
            }
          });
        }
      }
    </script>
    <header>
      <h2 id="text-title"> Product List </h2>
      <nav>
        <button class="headerButton" id="save-new-item" onClick="getValues()">Save</button>
        <a class="headerButton" id="cancel-operation-btn" href="index.php">Cancel</a>
      </nav>
    </header>
    <form id="product_form">
      <label for="sku">SKU: </label>
      <input type="text" id="sku" name="sku" placeholder="e.g. ABC0123">
      <br>
      <div id="skuEmpty" class="errorMSG"></div>
      <br>
      <label for="name">Name: </label>
      <input type="text" id="name" name="name" placeholder="e.g. Product Name">
      <br>
      <div id="nameEmpty" class="errorMSG"></div>
      <br>
      <label for="price">Price ($): </label>
      <input type="text" id="price" name="price" placeholder="e.g. 199.99">
      <br>
      <div id="priceErr" class="errorMSG"></div>
      <br>
      <label for="productType">What kind of product is it?:</label>
      <select id="productType" name="productType" onChange="perfChange(this.value);">
        <option id="" value="" selected>-Select-</option>
        <option id="DVD" value="1">DVD</option>
        <option id="Furniture" value="2">Furniture</option>
        <option id="Book" value="3">Book</option>
      </select>
      <br>
      <div id="selectEmpty" class="errorMSG"></div>
      <br>
      <div id="1" class="hideMe">
        <label for="size">Size (MB): </label>
        <input title="Please, insert only the size of the DVD in Megabytes." type="text" id="size" name="size" placeholder="e.g. 200.50">
        <br>
        <div id="sizeErr" class="errorMSG"></div>
        <br>
      </div>
      <div id="2" class="hideMe">
        <label for="height">Height(CM): </label>
        <input title="Please, insert only the height of the furniture in centimeters." type="text" id="height" name="height" placeholder="e.g. 22.3">
        <br>
        <div id="heightErr" class="errorMSG"></div>
        <br>
        <label for="width">Width (CM): </label>
        <input title="Please, insert only the width of the furniture in centimeters." type="text" id="width" name="width" placeholder="e.g. 30.45">
        <br>
        <div id="widthErr" class="errorMSG"></div>
        <br>
        <label for="length">Lenght (CM): </label>
        <input title="Please, insert only the length of the furniture in centimeters." type="text" id="length" name="length" placeholder="e.g. 51.71">
        <br>
        <div id="lengthErr" class="errorMSG"></div>
        <br>
      </div>
      <div id="3" class="hideMe">
        <label for="weight">Weight (KG): </label>
        <input title="Please, insert only the weight of the furniture in kilograms." type="text" id="weight" name="weight" placeholder="e.g. 0.5">
        <br>
        <div id="weightErr" class="errorMSG"></div>
        <br>
      </div>
    </form>
    <footer>
      <p>Scandiweb Test assignment</p>
    </footer>
    <script></script>
  </body>
</html>
