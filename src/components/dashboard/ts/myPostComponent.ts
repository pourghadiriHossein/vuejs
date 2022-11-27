const columns: any = [
  { name: 'id', align: 'left', label: 'ID', field: 'id', sortable: true },
  { name: 'title', align: 'center', label: 'Title', field: 'title', sortable: true },
  { name: 'description', align: 'center', label: 'Description', field: 'description', sortable: true },
]

const rows: any = [
  {
    id: 1,
    title: 'Masal',
    description: 'Best Mountains and View In World',
    image: 'src/image/mountains.jpg',
    latitude: 37.29,
    longitude: 49.59,
  },
  {
    id: 2,
    title: 'Masal',
    description: 'Best Mountains and View In World',
    image: 'src/image/mountains.jpg',
    latitude: 37.26,
    longitude: 49.61,
  },
]

export {columns, rows}
