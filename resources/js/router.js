import { createRouter, createWebHistory} from "vue-router";

import EmployeesIndex from "./components/EmployeesIndex";
import EmployeesCreate from "./components/EmployeesCreate";
import EmployeesEdit from "./components/EmployeesEdit";
import EmployeesAssignRestaurant from "./components/EmployeesAssignRestaurant";

const routes = [
    {
        path: '/home',
        name: 'employees.index',
        component: EmployeesIndex
    },
    {
        path: '/employees/create',
        name: 'employees.create',
        component: EmployeesCreate,
    },
    {
        path: '/employees/edit/:id',
        name: 'employees.edit',
        component: EmployeesEdit,
        props: true
    },
    {
        path: '/employees/assign/:id/restaurant',
        name: 'employees.assign.restaurant',
        component: EmployeesAssignRestaurant,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
