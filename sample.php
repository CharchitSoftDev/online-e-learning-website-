<?php include 'header.php';
/*
$url = 'https://www.burning-desire.in/economics/TCPDF/examples/invoice.php';

$fields = array(
  'txnid'      => $txnid,
  'name'      => $firstname,
  'amount'    => $amount,
  'desc'      => $productinfo
);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

var_dump($result);
*/

$str = "abcdef 2";
$len = strlen($str);
$res = substr($str,$len-1);
echo $res;

?>
<div class="container">
  <h2>Modal Example</h2>

  <form method="post" action="success.php" name="payuForm">
    <input type="hidden" name="txnid" value="123456" />
    <input type="hidden" name="amount" value="1000" />
    <input type="hidden" name="productinfo" value="Micro-Economics 1" />
    <input type="hidden" name="email" value="sahib@burning-desire.in" />
    <input type="hidden" name="firstname" value="sahib" />
    <button type="submit">Pay for Micro-Economics - 1,000/-</button>
  </form>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subscribe To our Service</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
      </div>

    </div>
  </div>

</div>


<div class="dashboard">
  <div class="sample"></div>
  <div class="sample"></div>
  <div class="sample"></div>
  <div class="sample"></div>
  <div class="sample"></div>
  <div class="sample"></div>
</div>

<?php include 'footer.php'; ?>
