import 'package:flutter/material.dart';
import 'package:webdirapp/screens/directory_master.dart';

class WebDirApp extends StatefulWidget {
  const WebDirApp({super.key});

  @override
  State<WebDirApp> createState() => _WebDirAppState();
}

class _WebDirAppState extends State<WebDirApp> {
  Brightness _brightness = Brightness.light;


  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Web Directory',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Annuaire Web'),
          shape: const Border(
            bottom: BorderSide(
              color: Colors.black,
              width: 2
              )
            ),
            /*actions: [
            IconButton(
            icon: Icon(Theme.of(context).brightness == Brightness.light ? Icons.dark_mode : Icons.light_mode),
            onPressed: () {
              setState(() {
                if (_brightness == Brightness.light) {
                  _brightness = Brightness.dark;
                } else {
                  _brightness = Brightness.light;
                }
              });
            },)
            ],*/
        ),
        body: const Center(
          child: DirectoryMaster(),
        )
      ),
      theme: ThemeData(
        scaffoldBackgroundColor: Colors.white,
        listTileTheme: const ListTileThemeData(
          tileColor: Colors.white,
          textColor: Colors.black
        ),
        dialogTheme: const DialogTheme(
          backgroundColor: Colors.white
        ),
        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.yellow
        ),
        primaryColor: Colors.white,
        colorScheme: Theme.of(context).colorScheme.copyWith(
          primary: Colors.yellow,
          secondary: Colors.white,
          brightness: Brightness.light,
        ),
      ),
      darkTheme: ThemeData(
        scaffoldBackgroundColor: Colors.black,
        listTileTheme: const ListTileThemeData(
          tileColor: Color.fromARGB(255, 36, 36, 36),
          textColor: Colors.white
        ),
        dialogTheme: const DialogTheme(
          backgroundColor: Color.fromARGB(255, 38, 38, 38)
        ),
        appBarTheme: const AppBarTheme(
          backgroundColor: Colors.orange
        ),
        primaryColor: Colors.black,
        textTheme: ThemeData().textTheme.apply(
          bodyColor: Colors.white,
          displayColor: Colors.white
        ),
        colorScheme: ThemeData().colorScheme.copyWith(
          primary: Colors.orange,
          secondary: Colors.black,
          brightness: Brightness.dark,
        ),
      ),
      themeMode: ThemeMode.system,
    );
  }
}