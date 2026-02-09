package main

import (
	"bytes"
	"encoding/json"
	"fmt"
	"io"
	"net/http"
)

func main() {
	url := "http://127.0.0.1:8000/api/v1/payment/create"
	apiKey := "mpk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"

	payload := map[string]any{
		"order_id":       "ORDER-GO-1001",
		"amount":         250000,
		"payment_method": "bank_transfer",
		"payment_channel": "bca_va",
		"customer": map[string]any{
			"name":  "John Doe",
			"email": "john@example.com",
		},
	}

	body, _ := json.Marshal(payload)

	req, _ := http.NewRequest(http.MethodPost, url, bytes.NewBuffer(body))
	req.Header.Set("Authorization", "Bearer "+apiKey)
	req.Header.Set("Content-Type", "application/json")

	client := &http.Client{}
	resp, err := client.Do(req)
	if err != nil {
		panic(err)
	}
	defer resp.Body.Close()

	responseBody, _ := io.ReadAll(resp.Body)
	fmt.Println(string(responseBody))
}
