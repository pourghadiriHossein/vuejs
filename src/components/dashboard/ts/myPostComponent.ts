import { Post } from 'src/models/post';
import { ref } from "vue";

const columns: any = [
  { name: 'id', align: 'left', label: 'ID', field: 'id', sortable: true },
  { name: 'title', align: 'center', label: 'Title', field: 'title', sortable: true },
  { name: 'description', align: 'center', label: 'Description', field: 'description', sortable: true },
]

const rows = ref();

const pagination = ref({
  sortBy: 'desc',
  descending: false,
  page: 1,
  rowsPerPage: 5,
  rowsNumber: 100
})
const onRequest = (data: any) => {
  if(!data){
    Post.myPosts(1)
    .then(
      (response) => {
        rows.value = response.data.posts;
        pagination.value.page = response.data.meta?.pagination?.posts.current_page ?? 1;
        pagination.value.rowsNumber = response.data.meta?.pagination?.posts.total ?? 1;
      }
      )
    }
    else{
    Post.myPosts(data.pagination.page)
    .then(
      (response) => {
        rows.value = response.data.posts;
        pagination.value.page = response.data.meta?.pagination?.posts.current_page ?? 1;
        pagination.value.rowsNumber = response.data.meta?.pagination?.posts.total ?? 1;
      }
    )
  }
}
onRequest(null);

export {columns, rows, pagination, onRequest}
