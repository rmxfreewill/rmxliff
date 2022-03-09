
<?php


    function getChatMessage($asCol){

        $UserName =$asCol[0];
        $SoldTo =$asCol[1];
        $ShipTo =$asCol[2];
        $Msg =$asCol[3];

        $jsonLink= '
        {
          "type": "flex",
             "altText": "RMX Info",
             
            "contents": 
            {
              "type": "bubble",
              "body": {
                "type": "box",
                "layout": "vertical",
                "contents": [
                  {
                    "type": "text",
                    "text": "RMX System",
                    "weight": "bold",
                    "align": "center",
                    "gravity": "center",
                    "size": "xl",
                    "color": "#0000CC"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                      {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                          {
                            "type": "text",
                            "text": "สวัสดีครับคุณ",
                            "align": "start"
                          },
                          {
                            "type": "text",
                            "text": "'.$UserName.'",
                            "align": "end",
                            "wrap": true,
                            "color": "#0000CC"
                          }
                        ]
                      },
                      {
                        "type": "box",
                        "layout": "vertical",
                        "contents": [
                            {
                            "type": "separator",
                            "color": "#CC0000"
                            },
                          {
                            "type": "text",
                            "text": "'.$SoldTo.'",
                            "align": "end"
                          },
                          {
                            "type": "text",
                            "text": "'.$ShipTo.'",
                            "align": "end"
                          },
                          {
                            "type": "separator",
                            "color": "#CC0000"
                          },
                          {
                            "type": "text",
                            "text": "ข้อความที่ส่งมาจะถูกส่งต่อให้ Admin ครับ",
                            "wrap": true
                          }
                          
                        ]
                      },
                      {
                        "type": "separator",
                        "color": "#CC0000"
                      },
                      {
                        "type": "text",
                        "text": "'.$Msg.'",
                        "color": "#0000CC",
                        "wrap": true
                      },
                      {
                        "type": "separator",
                        "color": "#CC0000"
                      }
                    ],
                    "borderWidth": "normal"
                  }
                ]
              }
            }
        }';

        return $jsonLink;

    }

    function old_getTicketMessage($asCol){
       
        $TicketNo =$asCol[0];
        $TicketDate =$asCol[1];
        $OrderNo =$asCol[2];
        $OrderDate =$asCol[3];
        $ShipTo =$asCol[4];
        $Product =$asCol[5];
        $Plant =$asCol[6];        
        $OrderQty =$asCol[7];
        $TicketQty =$asCol[8];
        $Driver =$asCol[9];
        $TruckNo =$asCol[10];
        $LeaveTime =$asCol[12];
        $Condition =$asCol[13];

        $jsonLink= '
        {
            "type": "flex",
            "altText": "Ticket Info",
            "contents":               
        {
            "type": "bubble",
            "body": {
            "type": "box",
            "layout": "vertical",
            "contents": [
                {
                "type": "text",
                "text": "Ticket",                      
                "color": "#000099",
                "size": "md"
                },
                {
                "type": "text",
                "text": "'.$TicketNo.'",
                "size": "xl",
                "margin": "md",
                "align": "end"
                },                   
                {
                "type": "box",
                "layout": "vertical",
                "margin": "xxl",
                
                "contents": [
                    {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                        {
                        "type": "text",
                        "text": "Ticket Date",
                        "color": "#000099",
                        "size": "md",
                        "flex": 0
                        },
                        {
                        "type": "text",
                        "text": "'.$TicketDate.'",
                        "size": "md",
                        "color": "#111111",
                        "align": "end"
                        }
                    ]
                    }
                    
                ]
                },

                {
                    "type": "text",
                    "text": "Ship To",
                    "color": "#000099",
                    "size": "md",
                    "wrap": true
                },
                {
                    "type": "text",
                    "text": "'.$ShipTo.'",
                    "size": "md",
                    "color": "#111111",
                    "wrap": true,
                    "align": "end"
                },
                {
                    "type": "text",
                    "text": "Product",
                    "color": "#000099",
                    "size": "md",
                    "wrap": true
                },
                {
                    "type": "text",
                    "text": "'.$Product.'",
                    "size": "md",
                    "color": "#111111",
                    "wrap": true,
                    "align": "end"
                },
                {
                    "type": "text",
                    "text": "Plant",
                    "color": "#000099",
                    "size": "md",
                    "wrap": true
                },
                {
                    "type": "text",
                    "text": "'.$Plant.'",
                    "size": "md",
                    "color": "#111111",
                    "wrap": true,
                    "align": "end"
                },
                
                    
                {
                    "type": "box",
                    "layout": "vertical",
                    "margin": "xxl",
                    "contents": [


                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Ticket Qty",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$TicketQty.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },
                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Driver",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$Driver.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },
                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Truck No",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$TruckNo.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },
                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Leave Time",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$LeaveTime.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    }
                    
                    ]
                }
                
            ]
            },
            "styles": {
            "footer": {
                "separator": true
            }
            }
        }
        
        
        }';

        return $jsonLink;

    }

    function getTicketMessage($asCol){
       
        $TicketNo =$asCol[0];
        $TicketDate =$asCol[1];
        $OrderNo =$asCol[2];
        $OrderDate =$asCol[3];
        $ShipTo =$asCol[4];
        $Product =$asCol[5];
        $Plant =$asCol[6];        
        $OrderQty =$asCol[7];
        $TicketQty =$asCol[8];
        $Driver =$asCol[9];
        $TruckNo =$asCol[10];
        $LeaveTime =$asCol[12];
        $Condition =$asCol[13];

        $jsonLink= '
        {
            "type": "flex",
            "altText": "Ticket Info",
            "contents":               
        {
            "type": "bubble",
            "body": {
            "type": "box",
            "layout": "vertical",
            "contents": [
                {
                    "type": "text",
                    "text": "Ticket",                      
                    "color": "#000099",
                    "size": "md"
                },
                {
                    "type": "text",
                    "text": "'.$TicketNo.'",
                    "size": "xl",
                    "margin": "md",
                    "align": "end"
                },                   
                                               
                {
                    "type": "box",
                    "layout": "vertical",
                    "margin": "xxl",
                    "contents": [


                        {
                            "type": "box",
                            "layout": "horizontal",
                            "contents": [
                                {
                                "type": "text",
                                "text": "Ticket Date",
                                "color": "#000099",
                                "size": "md",
                                "flex": 0
                                },
                                {
                                "type": "text",
                                "text": "'.$TicketDate.'",
                                "size": "md",
                                "color": "#111111",
                                "align": "end"
                                }
                            ]
                        },

                        {
                            "type": "box",
                            "layout": "horizontal",
                            "contents": [
                            {
                                "type": "text",
                                "text": "Ship To",
                                "color": "#000099",
                                "size": "md",        
                                "flex": 0
                            },
                            {
                                "type": "text",
                                "text": "'.$ShipTo.'",
                                "size": "md",
                                "color": "#111111",
                                "wrap": true,
                                "align": "end"
                            }
                            ]
                        },

                        {
                            "type": "box",
                            "layout": "horizontal",
                            "contents": [
                            {
                                "type": "text",
                                "text": "Product",
                                "color": "#000099",
                                "size": "md",        
                                "flex": 0
                            },
                            {
                                "type": "text",
                                "text": "'.$Product.'",
                                "size": "md",
                                "color": "#111111",
                                "wrap": true,
                                "align": "end"
                            }
                            ]
                        },
                        
                        {
                            "type": "box",
                            "layout": "horizontal",
                            "contents": [
                            {
                                "type": "text",
                                "text": "Plant",
                                "color": "#000099",
                                "size": "md",        
                                "flex": 0
                            },
                            {
                                "type": "text",
                                "text": "'.$Plant.'",
                                "size": "md",
                                "color": "#111111",
                                "wrap": true,
                                "align": "end"
                            }
                            ]
                        },

                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Ticket Qty",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$TicketQty.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },


                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Driver",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$Driver.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },
                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Truck No",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$TruckNo.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    },
                    {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                        {
                            "type": "text",
                            "text": "Leave Time",
                            "color": "#000099",
                            "size": "md",        
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$LeaveTime.'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                        ]
                    }
                    
                    ]
                }
                
            ]
            },
            "styles": {
            "footer": {
                "separator": true
            }
            }
        }
        
        
        }';

        return $jsonLink;

    }

    function old_getOrderMessage($asCol){

        //$TicketNo =$asCol[0];
        //$TicketDate =$asCol[1];
        $OrderNo =$asCol[2];
        $OrderDate =$asCol[3];
        //$ShipTo =$asCol[4];
        $Product =$asCol[5];
        $Plant =$asCol[6];        
        $OrderQty =$asCol[7];
        //$TicketQty =$asCol[8];
        //$Driver =$asCol[9];
        //$TruckNo =$asCol[10];
        //$LeaveTime =$asCol[12];
        $Condition =$asCol[13];

        $jsonLink= '
        {
            "type": "flex",
            "altText": "Order Info",
            "contents":               
            {
                "type": "bubble",
                "body": {
                "type": "box",
                "layout": "vertical",
                "contents": [
                    {
                    "type": "text",
                    "text": "Order No",                      
                    "color": "#000099",
                    "size": "md"
                    },
                    {
                    "type": "text",
                    "text": "'.$OrderNo.'",
                    "size": "xl",
                    "margin": "md",
                    "align": "end"
                    },                   
                    {
                    "type": "box",
                    "layout": "vertical",
                    "margin": "xxl",
                    
                    "contents": [
                        {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [
                            {
                            "type": "text",
                            "text": "Order Date",
                            "color": "#000099",
                            "size": "md",
                            "flex": 0
                            },
                            {
                            "type": "text",
                            "text": "'.$OrderDate.'",
                            "size": "md",
                            "color": "#111111",
                            "align": "end"
                            }
                        ]
                        }
                        
                    ]
                    },
                    {
                        "type": "text",
                        "text": "Product",
                        "color": "#000099",
                        "size": "md",
                        "wrap": true
                    },
                    {
                        "type": "text",
                        "text": "'.$Product.'",
                        "size": "md",
                        "color": "#111111",
                        "wrap": true,
                        "align": "end"
                    },
                    {
                        "type": "text",
                        "text": "Plant",
                        "color": "#000099",
                        "size": "md",
                        "wrap": true
                    },
                    {
                        "type": "text",
                        "text": "'.$Plant.'",
                        "size": "md",
                        "color": "#111111",
                        "wrap": true,
                        "align": "end"
                    },
                    
                        
                    {
                        "type": "box",
                        "layout": "vertical",
                        "margin": "xxl",
                        "contents": [
                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "Order Qty",
                                    "color": "#000099",
                                    "size": "md",        
                                    "flex": 0
                                },
                                {
                                    "type": "text",
                                    "text": "'.$OrderQty.'",
                                    "size": "md",
                                    "color": "#111111",
                                    "align": "end"
                                }
                                ]
                            }                        
                        ]
                    },
                    
                    {
                        "type": "text",
                        "text": "Condition",
                        "color": "#000099",
                        "size": "md",
                        "wrap": true
                    },
                    {
                        "type": "text",
                        "text": "'.$Condition.'",
                        "size": "md",
                        "color": "#111111",
                        "wrap": true,
                        "align": "end"
                    }
                ]
                },
                "styles": {
                "footer": {
                    "separator": true
                }
                }
            }
        
        
        }';

        return $jsonLink;

    }

    function getOrderMessage($asCol){

        //$TicketNo =$asCol[0];
        //$TicketDate =$asCol[1];
        $OrderNo =$asCol[2];
        $OrderDate =$asCol[3];
        //$ShipTo =$asCol[4];
        $Product =$asCol[5];
        $Plant =$asCol[6];        
        $OrderQty =$asCol[7];
        //$TicketQty =$asCol[8];
        //$Driver =$asCol[9];
        //$TruckNo =$asCol[10];
        //$LeaveTime =$asCol[12];
        $Condition =$asCol[13];

        $jsonLink= '
        {
            "type": "flex",
            "altText": "Order Info",
            "contents":               
            {
                "type": "bubble",
                "body": {
                "type": "box",
                "layout": "vertical",
                "contents": [
                    {
                        "type": "text",
                        "text": "Order No",                      
                        "color": "#000099",
                        "size": "md"
                    },
                    {
                        "type": "text",
                        "text": "'.$OrderNo.'",
                        "size": "xl",
                        "margin": "md",
                        "align": "end"
                    },                                                                
                    {
                        "type": "box",
                        "layout": "vertical",
                        "margin": "xxl",
                        "contents": [

                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                    {
                                        "type": "text",
                                        "text": "Order Date",
                                        "color": "#000099",
                                        "size": "md",
                                        "flex": 0
                                    },
                                    {
                                        "type": "text",
                                        "text": "'.$OrderDate.'",
                                        "size": "md",
                                        "color": "#111111",
                                        "align": "end"
                                    }
                                ]
                            },

                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "Product",
                                    "color": "#000099",
                                    "size": "md",        
                                    "flex": 0
                                },
                                {
                                    "type": "text",
                                    "text": "'.$Product.'",
                                    "size": "md",
                                    "color": "#111111",
                                    "wrap": true,
                                    "align": "end"
                                }
                                ]
                            },

                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "Plant",
                                    "color": "#000099",
                                    "size": "md",        
                                    "flex": 0
                                },
                                {
                                    "type": "text",
                                    "text": "'.$Plant.'",
                                    "size": "md",
                                    "color": "#111111",
                                    "wrap": true,
                                    "align": "end"
                                }
                                ]
                            },

                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "Order Qty",
                                    "color": "#000099",
                                    "size": "md",        
                                    "flex": 0
                                },
                                {
                                    "type": "text",
                                    "text": "'.$OrderQty.'",
                                    "size": "md",
                                    "color": "#111111",
                                    "wrap": true,
                                    "align": "end"
                                }
                                ]
                            },
                            
                            {
                                "type": "box",
                                "layout": "horizontal",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "Condition",
                                    "color": "#000099",
                                    "size": "md",        
                                    "flex": 0
                                },
                                {
                                    "type": "text",
                                    "text": "'.$Condition.'",
                                    "size": "md",
                                    "color": "#111111",
                                    "wrap": true,
                                    "align": "end"
                                }
                                ]
                            }  
                        ]
                    }
                    
                    
                ]
                },
                "styles": {
                "footer": {
                    "separator": true
                }
                }
            }
        
        
        }';

        return $jsonLink;

    }
    
    function getMenuMessage($asCol){

        $jsonLink= '{          
            "type": "flex",
            "altText": "RME Line Menu",
            "contents": {
                "type": "bubble",
                "body": {
                "type": "box",
                "layout": "vertical",
                "spacing": "md",
                "contents": [
                    {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                        {
                        "type": "text",
                        "text": "RMX Menu",
                        "align": "center",
                        "size": "xxl",
                        "weight": "bold"
                        },
                        {
                        "type": "text",
                        "text": "Menu Function List",
                        "wrap": true,
                        "weight": "bold",
                        "margin": "lg"
                        }
                    ]
                    },
                    {
                    "type": "separator"
                    },
                    {
                    "type": "box",
                    "layout": "vertical",
                    "margin": "lg",
                    "contents": [
                        {
                        "type": "box",
                        "layout": "baseline",
                        "contents": [
                            {
                            "type": "text",
                            "text": "1.",
                            "flex": 1,
                            "size": "lg",
                            "weight": "bold",
                            "color": "#666666"
                            },
                            {
                            "type": "text",
                            "text": "Last Ticket",
                            "wrap": true,
                            "flex": 9
                            }
                        ]
                        },
                        {
                        "type": "box",
                        "layout": "baseline",
                        "contents": [
                            {
                            "type": "text",
                            "text": "2.",
                            "flex": 1,
                            "size": "lg",
                            "weight": "bold",
                            "color": "#666666"
                            },
                            {
                            "type": "text",
                            "text": "Last Order",
                            "wrap": true,
                            "flex": 9
                            }
                        ]
                        },
                        {
                        "type": "box",
                        "layout": "baseline",
                        "contents": [
                            {
                            "type": "text",
                            "text": "3.",
                            "flex": 1,
                            "size": "lg",
                            "weight": "bold",
                            "color": "#666666"
                            },
                            {
                            "type": "text",
                            "text": "View User Info",
                            "wrap": true,
                            "flex": 9
                            }
                        ]
                        }
                    ]
                    }
                ]
                },
                "footer": {
                "type": "box",
                "layout": "horizontal",
                "spacing": "sm",
                "contents": [
                    {
                    "type": "button",
                    "style": "primary",
                    "height": "sm",
                    "action": {
                        "type": "message",
                        "label": "1",
                        "text": "®lastticket"
                    }
                    },
                    {
                    "type": "button",
                    "style": "primary",
                    "height": "sm",
                    "action": {
                        "type": "message",
                        "label": "2",
                        "text": "®lastorder"
                    }
                    },
                    {
                    "type": "button",
                    "style": "primary",
                    "height": "sm",
                    "action": {
                        "type": "message",
                        "label": "3",
                        "text": "®viewuser"
                    }
                    }
                ]
                }
            }
        }        
        ';
    
        return $jsonLink;

    }

    function getDisplayMessage($sText){

    
        $jsonLink= '
        {
          "type": "flex",
             "altText": "RMX Info",
             
            "contents": 
            {
              "type": "bubble",
              "body": {
                "type": "box",
                "layout": "vertical",
                "contents": [
                  {
                    "type": "text",
                    "text": "RMX System",
                    "weight": "bold",
                    "align": "center",
                    "gravity": "center",
                    "size": "xl",
                    "color": "#0000CC"
                  },
                  {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                      {
                        "type": "box",
                        "layout": "horizontal",
                        "contents": [                         
                          {
                            "type": "text",
                            "text": "'.$sText.'",
                            "align": "start",
                            "wrap": true,
                            "color": "#0000CC"
                          }
                        ]
                      },                     
                      {
                        "type": "separator",
                        "color": "#CC0000"
                      }
                    ],
                    "borderWidth": "normal"
                  }
                ]
              }
            }
        }';

        return $jsonLink;

    }


    function getArrayMessage($asTitle,$asCol){
      
        $jsonLink= '{
            "type": "flex",
            "altText": "Info",
            "contents":               
        {
            "type": "bubble",
            "body": {
            "type": "box",
            "layout": "vertical",
            "contents": [';

        if (count($asTitle) >=1){
            for ($x = 0; $x < count($asTitle); $x++) {
                $jsonLink= $jsonLink .' 
                    {
                        "type": "text",
                        "text": "'.$asTitle[$x].'",
                        "color": "#000099",
                        "size": "md",
                        "wrap": true
                    },
                    {
                        "type": "text",
                        "text": "'.$asCol[$x].'",
                        "size": "md",
                        "color": "#111111",
                        "wrap": true,
                        "align": "end"
                    },';
            }
        }
        $jsonLink= $jsonLink .' {
                    "type": "separator",
                    "color": "#CC0000"
                }                
            ]
            },
            "styles": {
            "footer": {
                "separator": true
            }
            }
        } }';

        return $jsonLink;

    }

    function getArrayColMessage($asTitle,$asCol){
      
        $jsonLink= '{
            "type": "flex",
            "altText": "Info",
            "contents":               
        {
            "type": "bubble",
            "body": {
            "type": "box",
            "margin": "xxl",
            "layout": "vertical",
            "contents": [';

        if (count($asTitle) >=1){
            for ($x = 0; $x < count($asTitle); $x++) {
                $jsonLink= $jsonLink .' 

                {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                        {
                            "type": "text",
                            "text": "'.$asTitle[$x].'",
                            "color": "#000099",
                            "size": "md",     
                            "wrap": true,   
                            "flex": 0
                        },
                        {
                            "type": "text",
                            "text": "'.$asCol[$x].'",
                            "size": "md",
                            "color": "#111111",
                            "wrap": true,
                            "align": "end"
                        }
                    ]
                },';
            }
        }
        $jsonLink= $jsonLink .' {
                    "type": "separator",
                    "color": "#CC0000"
                }                
            ]
            },
            "styles": {
            "footer": {
                "separator": true
            }
            }
        } }';

        return $jsonLink;

    }

/*------------------------------------------------------------------------------*/



function line_reply($url,$CompanyToken,$userId,$replyToken,$msg){
    //$msg = "ถามอะไรมาก็ตอบได้ UserId[" . $userId."] ".$text."[replay[".$replyToken."]]";
    try {
        $LINEDatas['url'] = $url;
        $LINEDatas['token'] = $CompanyToken;

        $messages = [];
        $messages['replyToken'] = $replyToken;
        $messages['messages'][0] = getFormatTextMessage($msg);

        $encodeJson = json_encode($messages);
        //wh_log('line_reply: ' .$encodeJson);
        $results = sendMessage($encodeJson,$LINEDatas);
        //wh_log('line_reply: Return');
    }
    catch(Exception $e) {
        wh_log('Exception: ' .$e->getMessage());
      
    }
}


function line_pushMsg222($url,$CompanyToken,$encodeJson){

  $LINEDatas['url'] = $url;
  $LINEDatas['token'] = $CompanyToken;

  $results = sendMessage($encodeJson,$LINEDatas);
  return $results;

}



function line_push($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    $messages['to'] = $userId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sendMessage($encodeJson,$LINEDatas);

  // print_r ($results);
  // echo ($results);
    return $results;
}


function line_multicast($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    //"to": ["U4af4980629...","U0c229f96c4..."],
    //u3333333^rrr77777777^t555555555^eeeee
    $asId = explode("^", $userId);
    $messages['to'] = $asId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sendMessage($encodeJson,$LINEDatas);

    print_r ($results);
    return $results;
}


/*------------------------------------------------------------------------------*/



function put_request($CompanyUrl,$userId,$CompanyId,$text,$datas){

  $Command="call sp_comp_insert_user_resquest ('".$userId."','".$CompanyId."','".$text."','".$datas."')";
  $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    

  $response = post_web_page($CompanyUrl,$curl_data);

}


function put_send($CompanyUrl,$userId,$CompanyId,$type,$datas,$sRet){


  $Command="call sp_comp_insert_line_send ('".$userId."','".$CompanyId."','".$type."','".$datas."','".$sRet."')";
  $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    


  print_r ($curl_data);
  $response = post_web_page($CompanyUrl,$curl_data);

}


/*==================================================================================*/

function wh_log($log_msg)
{
      
    try {
        $log_filename = "log";
        if (!file_exists($log_filename)) 
        {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
        // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
        //file_put_contents($log_file_data, date('H:m:s') . "\n", FILE_APPEND);
        file_put_contents($log_file_data, date('H:m:s').":::". $log_msg . "\n", FILE_APPEND);
    }
    catch(Exception $e) {
        wh_log('Exception: ' .$e->getMessage());

    }
} 

function wh_error($log_msg)
{
      
    try {
        $log_filename = "error";
        if (!file_exists($log_filename)) 
        {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename.'/err_' . date('d-M-Y') . '.log';
        // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
        //file_put_contents($log_file_data, date('H:m:s') . "\n", FILE_APPEND);
        file_put_contents($log_file_data, date('H:m:s').":::". $log_msg . "\n", FILE_APPEND);
    }
    catch(Exception $e) {
        wh_log('Exception: ' .$e->getMessage());

    }
} 

/*------------------------------------------------------------------------------*/



function getFormatTextMessage($text)
{
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;

    return $datas;
}

function sendMessage($encodeJson,$datas)
{
    $datasReturn = [];
    try {
        
        //wh_log('sendMessage: 1 =='.$datas['token']);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_URL => $datas['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $encodeJson,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$datas['token'],
                "cache-control: no-cache",
                "content-type: application/json; charset=UTF-8",
            ),
        ));
        //wh_log('sendMessage: 2 =='.$datas['token']);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        
        if ($err) {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $err;

            wh_log('-------------------------------------------');
            wh_log('sendMessage: 1)   '.$datas['token']);
            wh_log('sendMessage: 2)   '.$datas['url']);
            wh_log('sendMessage: 3)   '.$encodeJson);
            wh_log('sendMessage: Err) '.$err);
        } else {
            if($response == "{}"){
                $datasReturn['result'] = 'S';
                $datasReturn['message'] = 'Success';
            }else{
                $datasReturn['result'] = 'E';
                $datasReturn['message'] = $response;
            }
        }
    }
    catch(Exception $e) {
        wh_log('Exception: ' .$e->getMessage());
      
    }
    return $datasReturn;
}



function post_web_page( $url,$curl_data )
{
    $options = array(

      
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  //  $header['errno']   = $err;
  //  $header['errmsg']  = $errmsg;
  //  $header['content'] = $content;
    return $header;
}




function post_web_content( $url,$curl_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  
    return trim($content);
}


function send_command($CompanyUrl,$userId,$CompanyId,$Command){

    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    
    $response = post_web_content($CompanyUrl,$curl_data);
    return $response;

}


  function getTicketJSON($asCol){

    $TicketNo =$asCol[2];
    $TicketDate =$asCol[3];
    $ShipTo =$asCol[5];
    $Product =$asCol[6];
    $Plant =$asCol[7];
    $TicketQty =$asCol[9];
    $Driver =$asCol[10];
    $TruckNo =$asCol[11];
    $LeaveTime =$asCol[12];

    $jsonLink= '
    {
        "type": "flex",
        "altText": "Ticket Info",
        "contents":               
    {
        "type": "bubble",
        "body": {
        "type": "box",
        "layout": "vertical",
        "contents": [
            {
            "type": "text",
            "text": "Ticket",                      
            "color": "#000099",
            "size": "md"
            },
            {
            "type": "text",
            "text": "'.$TicketNo.'",
            "size": "xl",
            "margin": "md",
            "align": "end"
            },                   
            {
            "type": "box",
            "layout": "vertical",
            "margin": "xxl",
            
            "contents": [
                {
                "type": "box",
                "layout": "horizontal",
                "contents": [
                    {
                    "type": "text",
                    "text": "Ticket Date",
                    "color": "#000099",
                    "size": "md",
                    "flex": 0
                    },
                    {
                    "type": "text",
                    "text": "'.$TicketDate.'",
                    "size": "md",
                    "color": "#111111",
                    "align": "end"
                    }
                ]
                }
                
            ]
            },

            {
                "type": "text",
                "text": "Ship To",
                "color": "#000099",
                "size": "md",
                "wrap": true
            },
            {
                "type": "text",
                "text": "'.$ShipTo.'",
                "size": "md",
                "color": "#111111",
                "wrap": true
            },
            {
                "type": "text",
                "text": "Product",
                "color": "#000099",
                "size": "md",
                "wrap": true
            },
            {
                "type": "text",
                "text": "'.$Product.'",
                "size": "md",
                "color": "#111111",
                "wrap": true
            },
            {
                "type": "text",
                "text": "Plant",
                "color": "#000099",
                "size": "md",
                "wrap": true
            },
            {
                "type": "text",
                "text": "'.$Plant.'",
                "size": "md",
                "color": "#111111",
                "wrap": true
            },
            
                
            {
                "type": "box",
                "layout": "vertical",
                "margin": "xxl",
                "contents": [
                {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                    {
                        "type": "text",
                        "text": "Ticket Qty",
                        "color": "#000099",
                        "size": "md",        
                        "flex": 0
                    },
                    {
                        "type": "text",
                        "text": "'.$TicketQty.'",
                        "size": "md",
                        "color": "#111111",
                        "align": "end"
                    }
                    ]
                },
                {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                    {
                        "type": "text",
                        "text": "Driver",
                        "color": "#000099",
                        "size": "md",        
                        "flex": 0
                    },
                    {
                        "type": "text",
                        "text": "'.$Driver.'",
                        "size": "md",
                        "color": "#111111",
                        "align": "end"
                    }
                    ]
                },
                {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                    {
                        "type": "text",
                        "text": "Truck No",
                        "color": "#000099",
                        "size": "md",        
                        "flex": 0
                    },
                    {
                        "type": "text",
                        "text": "'.$TruckNo.'",
                        "size": "md",
                        "color": "#111111",
                        "align": "end"
                    }
                    ]
                },
                {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                    {
                        "type": "text",
                        "text": "Leave Time",
                        "color": "#000099",
                        "size": "md",        
                        "flex": 0
                    },
                    {
                        "type": "text",
                        "text": "'.$LeaveTime.'",
                        "size": "md",
                        "color": "#111111",
                        "align": "end"
                    }
                    ]
                }
                
                ]
            }
            
        ]
        },
        "styles": {
        "footer": {
            "separator": true
        }
        }
    }
    
    
    }';

    return $jsonLink;

  }

?>