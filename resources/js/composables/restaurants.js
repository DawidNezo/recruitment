import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useRestaurants() {
    // const assignableRestaurants = ref([]),
    //     errors = ref(''),
    //     router = useRouter();
    //
    // const getAssignableRestaurants = async (id) => {
    //     let response = await axios.get('/api/restaurants/assignable/' + id);
    //     assignableRestaurants.value = response.data.data;
    // }

    return {
        // errors,
        // router,
        // assignableRestaurants,
        // getAssignableRestaurants
    }
}
