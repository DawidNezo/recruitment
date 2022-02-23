import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useEmployees() {
    const employee = ref([]),
        employees = ref([]),
        errors = ref(''),
        router = useRouter(),
        assignableRestaurants = ref([]);

    const getEmployees = async () => {
        let response = await axios.get('/api/employees/index');
        employees.value = response.data.data;
    }

    const getEmployee = async (id) => {
        let response = await axios.get('/api/employees/show/' + id);
        employee.value = response.data.data;
    }

    const storeEmployee = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/employees/store', data)
            await router.push({ name: 'employees.index' })
        } catch (e) {
            if(e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateEmployee = async (id) => {
        errors.value = ''
        try {
            await axios.patch('/api/employees/update/' + id, employee.value)
            await router.push({ name: 'employees.index' })
        } catch (e) {
            if(e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const getAssignableRestaurants = async (id) => {
        let response = await axios.get('/api/restaurants/assignable/' + id);
        assignableRestaurants.value = response.data.data;
    }

    const assignRestaurant = async (id) => {
        errors.value = ''
        try {
            await axios.patch('/api/employees/assign/' + id + '/restaurant', employee.value)
            await router.push({ name: 'employees.index' })
        } catch (e) {
            if(e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyEmployee = async (id) => {
        await axios.delete('/api/employees/destroy/' + id)
    }

    return {
        errors,
        employee,
        employees,
        assignableRestaurants,
        getEmployees,
        getEmployee,
        storeEmployee,
        updateEmployee,
        destroyEmployee,
        assignRestaurant,
        getAssignableRestaurants
    }
}
