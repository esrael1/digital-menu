import axios from "../axios";

export const getMenuItems = (search = "") =>
  axios.get("/menu-items", { params: { search } });

export const createMenuItem = (data) =>
  axios.post("/menu-items", data);

export const deleteMenuItem = (id) =>
  axios.delete(`/menu-items/${id}`);
