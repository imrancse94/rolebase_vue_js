<template>
  <div :class="wrapperclass">
    <label>{{ title }}</label>
    <input
      autocomplete="off"
      type="text"
      :class="[{'is-invalid ' : errors},  classname ? classname : '']"
      :placeholder="title"
      @input="updateInput"
      v-model="modelValue"
    />
    <ErrorValidation v-if="errors" :msg="errors" />
  </div>
</template>

<script>
export default {
  data(){
    return {
      modelValue : ""
    }
  },
  mounted() {
    //console.log('this.model.modelValue',)
    //this.modelValue = this.value
  },
  methods: {
    updateInput() {
      this.$emit('input', this.modelValue)
    }
  },
  
  props: {
    title: {
      type: String,
      required: true,
    },
    
    errors: {
      type: String,
    },
    classname:{
      type: String,
      required: true,
    },
    wrapperclass:{
      type: String,
    }
  },
};
</script>
