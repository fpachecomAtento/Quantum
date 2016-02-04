var Q = undefined;
$(document).ready(function(){
	Q = new Quantum();
	Q.__construct();
});

var Quantum = function(){
	this.currentStep = 0;

	this.__construct = function(){
		$(window).resize(function(){Q.resizeChat(this);});
		this.prepareSteps();
		this.activateQueues();
		this.activeForms();
		this.resizeChat(window);
	}

	this.prepareSteps = function(){
		var properties = {
			start : quantumProperties.start
		}

		this.currentStep = properties.start;
		$.each(quantumProperties.steps,function(index, value){
			$(value).hide();
		});
		$(quantumProperties.steps[properties.start]).show();
	}

	this.activeForms = function(){
		$form = this.selectForm();
		
	}
		this.selectForm = function(){
			var $FormActive = $(quantumProperties.selectorForms);
			var res = new Array();
			$.each($FormActive,function(index, value){
				var callBack = $(value).attr('data-callback');
				$(value).submit(function(event){
					event.preventDefault();
					
					var stepTemplete = eval(callBack+'()');
					

				});
				res[index] = {
					obj : value,
					callback : callBack
				}
			});
			return res;
		}

	this.activateQueues = function(){
		$queues = $(quantumProperties.selectorQueues);
		$queues.click(this.actionQueues);
	}
		this.actionQueues = function(){
			var stepTemplete = Q.nextStep();
		}

	this.nextStep = function(){
		var nextS = quantumProperties.flow[Q.currentStep];
		var $nextS = $(quantumProperties.steps[nextS+1]);
		var $current = $(quantumProperties.steps[nextS]);
		Q.currentStep += 1;

		$current.hide();
		$nextS.show();

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

	this.resizeChat = function(win){
		var heightWindow = $(win).outerHeight();

		var h = $(quantumProperties.componentsChat['head']).outerHeight();
		var b = $(quantumProperties.componentsChat['body']);
		var f = 60;//$(quantumProperties.componentsChat['footer']).outerHeight();

		$(b).css({
			height : heightWindow-(h+f+0)
		});
	}
}

