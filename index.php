<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Scandiweb Application - List</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
  </head>
  <body>
    <header>
      <h2 id="text-title"> Product List </h2>
      <nav>
        <a class="headerButton" id="add-product-btn" href="add_product.php" data-role="button">ADD</a>
        <button class="headerButton" id="delete-product-btn" onclick="massDelete()">MASS DELETE</button>
      </nav>
    </header>
    <div id="root"></div>
    <footer>
      <p>Scandiweb Test assignment</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.24.0/babel.js"></script>
    <script src="./reactCaller.js" type="text/babel"></script>
    <script>
      function massDelete() {
        var checkedBoxes = document.querySelectorAll('input[class=delete-checkbox]:checked');
        var checkedBoxIds = Array.from(checkedBoxes).map(box => box.id);
        var numCheckedBoxes = checkedBoxes.length;
        if (numCheckedBoxes > 0) {
          $.ajax({
            url: 'indexDBDeleter.php',
            type: 'post',
            data: {
              action: 'deleteStuff',
              sku: checkedBoxIds
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
  </body>
</html>
