Payment request functions

$scope.live = false;
    $scope.newPayment = {feedback: "", policyNumber: "", phone: "", amount: 0, fname: "", lname: "", nationalId: "", agentName: "", agentId: -1, information: ""};
		
    $scope.requestPaymentPrime = function(){
        
        $scope.newPayment.agentName = "";
        $scope.newPayment.agentId = -1;
		
        if($scope.live){
$http.post('http://www.torque.co.rw/requestpayment/', {newPayment: $scope.newPayment}).success(function (data, status, headers, config) {
                //alert(JSON.stringify(data));
                if($scope.live){
                    $scope.newPayment = data;
                    $timeout( function(){ $scope.requestPaymentPrime(); }, 6000);
                }

            }).error(function(data, status){                  
                  alert("No internet connection...");			  
	   $scope.stopTransaction();

            });
        }
    }
	
	789773162
	
$scope.stopTransaction = function(){		
$scope.live = false;
$scope.newPayment.amount, fname: "", lname: "", nationalId: "", agentName: "", agentId: -1, information: "CANCELED"};
        $scope.newPayment.information = "CANCELED";
        $scope.newPayment.agentName = "";
        $scope.newPayment.agentId = -1;
        
    }
	
	
