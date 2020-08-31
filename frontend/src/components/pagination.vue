<template>
  <div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
      <li class="page-item">
        <button type="button" :disabled="!data.prev_page_url" @click.prevent="paginateTo(data.current_page -1)" class="page-link" href="#">«</button>
      </li>
      <li
        v-for="index in data.last_page"
        :key="index"
        :class="index === data.current_page ? 'active':''"
        class="page-item"
      >
       <button type="button"  @click.prevent="paginateTo(index)" class="page-link">{{index}}</button>
      </li>
      <li class="page-item">
        <button type="button" :disabled="!data.next_page_url" @click.prevent="paginateTo(data.current_page +1)" class="page-link" href="#">»</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "pagination",
  props: {
    data: {},
  },

  methods: {
    paginateTo(page) {

      if (this.$router.currentRoute.query.page != page) {
        this.paginateFunction(page);
      }
      
    },

    paginateFunction(page) {

      var queryparams = Object.assign({}, this.$router.currentRoute.query, { 'page': page });

      this.$router
        .push({
          path: this.$router.currentRoute.path,
          query: queryparams,
        })
        
      this.$emit("paginateTo", page);
    },
  },
}
</script>

