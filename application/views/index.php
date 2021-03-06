<html>
  <head>
    <title>Title</title>
  </head>

  <body>  
    <div id = "app">
    <h2>即時匯率轉換器</h2>
    幣別：
    <select name="currency" v-model="currency">
      <option value="USD">美金</option>
      <option value="TWD">台幣</option>
      <option value="JPY">日幣</option>
    </select>
    金額：<input v-model="price"  type="number" step="0.01" name="price"/> - 折扣： <input type="number" step="0.01" name="discount" v-model="discount" /> = 台幣結果： {{result}}
    <br/>
    <br/>
    <button v-on:click="calculate()">計算</button>
    <ul>
      <li style="color:red">注意：幣別為美金或日幣時，折扣功能無效.</li>
      <li style="color:red">注意：幣別為台幣時，需有折扣功能.</li>
    </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script>
      var app = new Vue({
        el: '#app',
        data: {
            price: 0.0,
            discount: 0.0,
            currency: "",
            result: 0.0,
        },
        methods: {
            calculate: async function() {
              let that = this;
              var myHeaders = new Headers();
              myHeaders.append("Content-Type", "application/json");

              var raw = JSON.stringify({
                "price": parseFloat(that.price),
                "discount": parseFloat(that.discount),
                "currency": that.currency
            });

            var requestOptions = {
              method: 'POST',
              headers: myHeaders,
              body: raw,
              redirect: 'follow'
            };
            
            fetch("https://ab77-118-160-15-32.ngrok.io/CodeIgniter-3.1.11/index.php/calculate", requestOptions)
              .then(response => response.text())
              .then(function(resp){
                let res = JSON.parse(resp)
                that.result = res.result;
              })
          },      
        }
      })
    </script>
  </body>
</html>