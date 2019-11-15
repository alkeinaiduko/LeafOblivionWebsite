<template>
	<transition name="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<div class="modal-header">
						<h3>
							<slot name="header">
								default header
							</slot>
						</h3>

						<span class="btn-close" @click="$emit('close')">&times;</span>
					</div>

					<div class="modal-body">
						<slot name="body">
						default body
						</slot>
					</div>

					<div class="modal-footers">
						<slot name="footer">
						default footer
						<button class="modal-default-button" @click="$emit('close')">
							OK
						</button>
						</slot>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>
