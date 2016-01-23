var Q = undefined;
$(document).ready(function(){
	Q = new Quantum();
	Q.__construct();
});

var Quantum = function(){
	this.currentStep = 0;

	this.__construct = function(){
		this.prepareSteps();
		this.activateQueues();
	}

	this.prepareSteps = function(){
		var properties = {
			start : 1
		}

		this.currentStep = properties.start;
		$.each(quantumProperties.steps,function(index, value){
			$(value).hide();
		});
		$(quantumProperties.steps[properties.start]).show();
	}

	this.activateQueues = function(){
		$queues = $(quantumProperties.selectorQueues);
		$queues.click(this.actionQueues);
	}
		this.actionQueues = function(){
			var stepTemplete = Q.nextStep();
			stepTemplete.current.obj.hide();
			stepTemplete.next.obj.show();
		}

	this.nextStep = function(){
		var nextS = quantumProperties.flow[Q.currentStep];
		var $nextS = $(quantumProperties.steps[nextS+1]);
		var $current = $(quantumProperties.steps[nextS]);
		Q.currentStep += 1;
		return {
				next : {
					obj : $nextS,
					step : nextS
				},
				current : {
					obj : $current,
					step : Q.currentStep	
				}
			};
	}
}

var quantumProperties = {
	selectorQueues : '[data-role = "q_queue"]',
	steps : [
		'[data-role="step_welcome"]',
		'[data-role="step_crm"]'
	],
	flow : [0,1,2,3]
}