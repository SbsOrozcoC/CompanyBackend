import "./bootstrap";
import Alpine from "alpinejs";
import Swal from "sweetalert2";
import 'datatables.net';
import 'datatables.net-responsive-dt';

window.Swal = Swal;
window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const countrySelect = document.getElementById("country");
    const citySelect = document.getElementById("city");

    if (!countrySelect || !citySelect) return;

    const selectedCity = citySelect.dataset.selected;
    
    async function loadCities(countryId, selectedCityId = null) {
        citySelect.innerHTML = "<option>Cargando...</option>";

        try {
            const response = await fetch(`/countries/${countryId}/cities`);
            const cities = await response.json();

            citySelect.innerHTML =
                '<option value="">Seleccione ciudad</option>';

            cities.forEach((city) => {
                const option = document.createElement("option");
                option.value = city.id;
                option.textContent = city.name;

                if (selectedCityId && city.id == selectedCityId) {
                    option.selected = true;
                }

                citySelect.appendChild(option);
            });
        } catch (e) {
            citySelect.innerHTML = "<option>Error al cargar</option>";
        }
    }

    countrySelect.addEventListener("change", function () {
        if (this.value) {
            loadCities(this.value);
        } else {
            citySelect.innerHTML =
                "<option>Seleccione un país primero</option>";
        }
    });

    if (countrySelect.value) {
        loadCities(countrySelect.value, selectedCity);
    }
});

document.addEventListener("submit", function (e) {
    if (!e.target.classList.contains("delete-form")) return;

    e.preventDefault();

    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción eliminará el empleado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc2626",
        cancelButtonColor: "#6b7280",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("employees-table");

    if (!table) return;

    if ($.fn.DataTable.isDataTable(table)) {
        $(table).DataTable().destroy();
    }

    $(table).DataTable({
        pageLength: 10,
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {

    const success = document.body.dataset.success;
    const errors = JSON.parse(document.body.dataset.errors || "[]");

    if (success) {
        Swal.fire({
            icon: "success",
            title: "Éxito",
            text: success,
            confirmButtonColor: "#2563eb",
        });
    }

    if (errors.length) {
        Swal.fire({
            icon: "error",
            title: "Error",
            html: errors.join("<br>"),
            confirmButtonColor: "#dc2626",
        });
    }
});

document.addEventListener("input", (e) => {

    if (e.target.classList.contains("only-numbers")) {
        e.target.value = e.target.value.replace(/\D/g, "");
    }

    if (e.target.classList.contains("no-special-chars")) {
        e.target.value = e.target.value.replace(/[^a-zA-Z0-9\s]/g, "");
    }
});


