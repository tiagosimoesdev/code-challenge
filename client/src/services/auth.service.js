import { useAuth0 } from "@auth0/auth0-vue";

const apiServerUrl = import.meta.env.VITE_API_SERVER_URL;

const authService = () => {
    const { isLoading, isAuthenticated, loginWithRedirect, logout, user, getAccessTokenSilently } = useAuth0();

    const login = () => {
        // Add any additional logic if needed
        loginWithRedirect();
    };

    const logoutUser = (params) => {
        // Add any additional logic if needed
        logout(params);
    };

    const isLoggedIn = () => {
        return isAuthenticated;
    };

    const getUserAccessToken = async () => {
        try {
           return await getAccessTokenSilently();
        } catch (error) {
            // Handle error if needed
            console.error("Error fetching access token", error);
            return null;
        }
    };


    return {
        isLoading,
        isAuthenticated,
        login,
        logoutUser,
        user,
        getUserAccessToken,
        isLoggedIn
    };
};

export default authService;