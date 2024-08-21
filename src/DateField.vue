<script setup>
import { props as blockProps } from "../../kirby-dreamform/src/utils/block"

const props = defineProps(blockProps)

const emit = defineEmits(["update", "open"])
const update = (value) => emit("update", { ...props.content, ...value })
const open = (e) => {
	if (e.target === e.currentTarget) {
		emit("open")
	}
}
</script>

<template>
	<div class="df-field" @dblclick="open">
		<df-field-header
			:requireLabel="true"
			:content="content"
			:fieldset="fieldset"
			@update="update"
		/>
		<div class="df-date-row">
			<df-field-input
				:content="content"
				:placeholder="$t('dreamform.dateField.dateFormat')"
				@update="update"
				icon="calendar"
			/>

			<div v-if="content.timepicker" class="df-input">
				{{ $t("dreamform.dateField.timeFormat") }}

				<button type="button" @click="update({ timepicker: false })">
					<k-icon type="remove" class="df-option-icon"></k-icon>
				</button>
			</div>

			<button
				v-if="!content.timepicker"
				@click="update({ timepicker: true })"
				type="button"
				class="df-option df-option-add-button is-select"
			>
				{{ $t("dreamform.dateField.addTimePicker") }}
				<k-icon type="clock" class="df-option-icon"></k-icon>
			</button>
		</div>
		<df-field-error
			v-if="content.required"
			:content="content"
			@update="update"
		/>
	</div>
</template>

<style lang="scss">
.df-date-row {
	display: flex;
	width: 100%;
	gap: var(--spacing-2);

	.df-input {
		width: 100%;
	}

	.df-option-icon {
		margin-left: var(--spacing-2);
	}
}
</style>
