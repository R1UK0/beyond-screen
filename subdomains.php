$user_subdomain = strtolower($username) . ".yourhub.local";
$subdomain_path = "/path/to/project-root/subdomains/" . strtolower($username);

if (!file_exists($subdomain_path)) {
    mkdir($subdomain_path, 0777, true);
}
