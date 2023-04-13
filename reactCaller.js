let data;

function ProductCard({ data }) {
  return (
    <div className="product-box">
      <input type="checkbox" className="delete-checkbox" id={data.sku} />
      <div className="product-info">
        <p>{data.sku}</p>
        <p>{data.name}</p>
        {data.price !== null && data.price !== undefined && (
          <p>{Number(data.price).toFixed(2)} $</p>
        )}
        {data.size !== null && data.size !== undefined && (
          <p>Size: {Number(data.size).toFixed(2)} MB</p>
        )}
        {data.weight !== null && data.weight !== undefined && (
          <p>Weight: {Number(data.weight).toFixed(2)} KG</p>
        )}
        {data.dimension !== null && data.dimension !== undefined && (
          <p>Dimension: {data.dimension}</p>
        )}
      </div>
    </div>
  );
}

function CardList({ data }) {
  return (
    <div className="card-list">
      {data.map((data) => (
        <ProductCard key={data.sku} data={data} />
      ))}
    </div>
  );
}

$(function () {
  $.ajax({
    url: "indexDBCaller.php",
    context: document.body,
    success: function (response) {
      console.log(response);
      data = JSON.parse(response);
      if (Array.isArray(data)) {
        ReactDOM.render(
          <CardList data={data} />,
          document.getElementById("root")
        );
      } else {
        console.error("Data is not an array");
      }
    },
  });
});
