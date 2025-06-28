export const roleFormatter = (role_id) => {
    switch (role_id) {
        case 1:
            return 'SuperAdmin'
            break;
        case 2:
            return 'Admin'
            break;
        case 3:
            return 'User'
            break;
        default:
            return 'Unassigned'
            break;
    }
}
export const moneyFormatter = (amount) => {
    // Check if amount is not a valid number
    if (isNaN(amount) || amount === null || amount === undefined) {
        return ''; // Return empty string
    }
    // Convert amount to number and format with commas for thousands separator
    return Number(amount).toLocaleString('en-US', {maximumFractionDigits: 2});
}

export const convertWebMercatorToLatLng = (x, y) => {
    const R = 6378137; // Earth’s radius in meters
    const lng = (x / R) * (180 / Math.PI);
    const lat = (2 * Math.atan(Math.exp(y / R)) - Math.PI / 2) * (180 / Math.PI);
    return [lat, lng]; // Returns [latitude, longitude]
}