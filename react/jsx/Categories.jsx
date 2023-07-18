import axios from "axios";
import React, { useEffect, useState } from "react";

const Categorie = (props) => {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        axios.get("http://localhost:8000/api/categories")
            .then((response) => {
                const allCategories = response.data["hydra:member"];
                const limitedCategories = allCategories.slice(0, 6);
                setCategories(limitedCategories);
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }, []);

    return (
        <div className="d-flex flex-wrap justify-content-center">
            {categories.map((categorie, index) => (
                <div
                    className="card text-bg-dark mt-5 pt-3 px-2 mx-5 col-3"
                    style={{ width: '24rem', height: '29rem' }}
                    key={index}
                    id="card-body"
                >
                    <img
                        src={'img/category/' + categorie.image}
                        className="card-img-top"
                        alt={categorie.libelle}
                        height="80%"
                    />
                    <div className="card-body">
                        <h5 className="card-title" id="card-text">
                            {categorie.libelle}
                        </h5>
                    </div>
                </div>
            ))}
        </div>
    );
};
export default Categorie;