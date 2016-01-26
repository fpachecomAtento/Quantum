var quantumProperties = {
	selectorQueues : '[data-role = "q_queue"]',
	steps : [
		'[data-role="step_welcome"]', // 0
		'[data-role="step_crm"]', // 1
		'[data-role="step_wait"]', // 2
		'[data-role="step_chat"]' // 3
	],
	flow : [0,1,2,3],
	selectorForms : '[data-submit="false"]'
}