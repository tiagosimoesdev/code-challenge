import { callApi } from "./api.service";

const apiServerUrl = import.meta.env.VITE_API_SERVER_URL;

export const getAllCountries = async (accessToken) => {
  const config = {
    url: `${apiServerUrl}/api/v1/countries/`,
    method: "GET",
    headers: {
      "content-type": "application/json",
      Authorization: `Bearer ${accessToken}`,
    },
  };

  const { data, error } = await callApi({ config });

  return {
    data: data || null,
    error,
  };
};
