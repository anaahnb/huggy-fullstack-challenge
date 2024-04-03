import { ref, onMounted } from 'vue';
import axios from 'axios';

export default function useCidades() {
 const cidades = ref([]);

 const fetchCidades = async () => {
    try {
      const response = await axios.get('/api/cidades');
      cidades.value = response.data;
      console.log(cidades.value)
    } catch (error) {
      console.error('Erro ao buscar cidades:', error);
    }
 };

 onMounted(fetchCidades);

 return {
    cidades,
    fetchCidades,
 };
}
