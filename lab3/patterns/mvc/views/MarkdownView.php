<?php
namespace MVC\Views;

class MarkdownView
{
    public function render(array $data): string
    {
        $output = "# Информация о пользователях\n\n";
        
        foreach ($data as $user) {
            $output .= "## {$user['first_name']} {$user['last_name']}\n";
            $output .= "- **Email:** {$user['email']}\n";
            $output .= "- **ID:** {$user['id']}\n\n";
        }
        
        return $output;
    }
}